<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Employee;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $foldersQuery = Folder::with('employee');

        if ($search !== '') {
            $normalizedSearch = mb_strtolower($search);
            $driver = DB::connection()->getDriverName();

            $foldersQuery->where(function ($query) use ($normalizedSearch, $driver) {
                $query->whereRaw('LOWER(CAST(id AS CHAR)) LIKE ?', ["%{$normalizedSearch}%"])
                    ->orWhereHas('employee', function ($employeeQuery) use ($normalizedSearch) {
                        $employeeQuery
                            ->whereRaw('LOWER(employee_number) LIKE ?', ["%{$normalizedSearch}%"])
                            ->orWhereRaw('LOWER(first_name) LIKE ?', ["%{$normalizedSearch}%"])
                            ->orWhereRaw('LOWER(last_name) LIKE ?', ["%{$normalizedSearch}%"])
                            ->orWhereRaw('LOWER(email) LIKE ?', ["%{$normalizedSearch}%"]);
                    });

                if ($driver === 'sqlite') {
                    $query->orWhereHas('employee', function ($employeeQuery) use ($normalizedSearch) {
                        $employeeQuery->whereRaw(
                            "LOWER(COALESCE(first_name, '') || ' ' || COALESCE(last_name, '')) LIKE ?",
                            ["%{$normalizedSearch}%"]
                        );
                    });

                    return;
                }

                $query->orWhereHas('employee', function ($employeeQuery) use ($normalizedSearch) {
                    $employeeQuery->whereRaw(
                        "LOWER(CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))) LIKE ?",
                        ["%{$normalizedSearch}%"]
                    );
                });
            });
        }

        $folders = $foldersQuery->latest()->get();

        return view('folders.index', compact('folders', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::query()
            ->whereDoesntHave('folder')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('folders.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'integer', 'exists:employees,id', 'unique:folders,employee_id'],
        ]);

        Folder::create([
            'employee_id' => $validated['employee_id'],
            'is_complete' => false,
            'remarks' => null,
        ]);

        return redirect()
            ->route('folder.index')
            ->with('success', 'Le dossier a été créé avec succès.');
    }

    /**
     * Show the form for adding a document to an existing folder.
     */
    public function createDocument(Request $request)
    {
        $employees = Employee::query()
            ->whereHas('folder')
            ->with('folder')
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        $selectedEmployeeId = $request->query('employee_id');

        return view('folders.add-document', compact('employees', 'selectedEmployeeId'));
    }

    /**
     * Store a new document inside an existing folder.
     */
    public function storeDocument(Request $request)
    {
        $validated = $request->validate([
            'employee_id' => ['required', 'integer', 'exists:employees,id', 'exists:folders,employee_id'],
            'file' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,xls,xlsx,doc,docx',
                'max:'.$this->maxUploadKilobytes(),
            ],
        ]);

        $employee = Employee::with('folder')->findOrFail($validated['employee_id']);
        $folder = $employee->folder;

        if (! $folder) {
            return back()
                ->withErrors(['employee_id' => 'Cet employé doit posséder un dossier avant d’ajouter un document.'])
                ->withInput();
        }

        $this->storeDocumentFile($folder, $request->file('file'));

        return redirect()
            ->route('folders.show', $folder->id)
            ->with('success', 'Le document a été ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Folder $folder)
    {
        $folder->load('employee');

        return view('folders.show', compact('folder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Folder $folder)
    {
        //
    }

    private function maxUploadKilobytes(): int
    {
        $uploadLimit = $this->toKilobytes(ini_get('upload_max_filesize'));
        $postLimit = $this->toKilobytes(ini_get('post_max_size'));

        $limits = array_filter([$uploadLimit, $postLimit], static fn ($value) => $value > 0);

        if ($limits === []) {
            return 10240;
        }

        return (int) min($limits);
    }

    private function toKilobytes(string|false|null $value): int
    {
        if (! is_string($value) || trim($value) === '') {
            return 0;
        }

        $value = trim($value);
        $unit = strtolower(substr($value, -1));
        $number = (float) $value;

        return match ($unit) {
            'g' => (int) round($number * 1024 * 1024),
            'm' => (int) round($number * 1024),
            'k' => (int) round($number),
            default => (int) round($number / 1024),
        };
    }

    private function storeDocumentFile(Folder $folder, $file): void
    {
        $storedPath = null;

        try {
            $originalName = $file->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = strtolower((string) $file->getClientOriginalExtension());
            $safeBaseName = Str::slug($baseName) ?: 'document';
            $storedFileName = $safeBaseName.'-'.now()->format('YmdHis').'.'.$extension;

            $storedPath = $file->storeAs(
                'documents/'.$folder->id,
                $storedFileName,
                'public'
            );

            Document::create([
                'folder_id' => $folder->id,
                'title' => $baseName ?: $safeBaseName,
                'document_type' => 'Document',
                'file_name' => $originalName,
                'file_path' => $storedPath,
                'file_type' => $extension ?: 'file',
                'file_size' => $file->getSize() ?? 0,
            ]);
        } catch (\Throwable $throwable) {
            if ($storedPath) {
                Storage::disk('public')->delete($storedPath);
            }

            throw $throwable;
        }
    }
}
