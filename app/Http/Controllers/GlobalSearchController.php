<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        if (mb_strlen($query) < 2) {
            return view('search.global-results', [
                'query' => $query,
                'employeeResults' => collect(),
                'folderResults' => collect(),
            ]);
        }

        $employeeResults = Employee::query()
            ->with('folder')
            ->where(function (Builder $builder) use ($query) {
                $this->applyEmployeeSearch($builder, $query);
            })
            ->latest()
            ->limit(5)
            ->get()
            ->map(function (Employee $employee) {
                $fullName = trim((string) $employee->full_name);
                $initials = collect(explode(' ', $fullName))
                    ->filter()
                    ->take(2)
                    ->map(fn ($part) => mb_substr($part, 0, 1))
                    ->implode('');

                return [
                    'href' => route('employee.show', ['employee' => $employee->id], false),
                    'title' => $fullName !== '' ? $fullName : 'Employé',
                    'meta' => $employee->employee_number ? 'Matricule : '.$employee->employee_number : null,
                    'badge' => 'Employé',
                    'initials' => $initials !== '' ? mb_strtoupper($initials) : 'EM',
                ];
            });

        $folderResults = Folder::query()
            ->with('employee')
            ->where(function (Builder $builder) use ($query) {
                $this->applyFolderSearch($builder, $query);
            })
            ->latest()
            ->limit(5)
            ->get()
            ->map(function (Folder $folder) {
                $employeeName = trim((string) $folder->employee?->full_name);
                $initials = collect(explode(' ', $employeeName))
                    ->filter()
                    ->take(2)
                    ->map(fn ($part) => mb_substr($part, 0, 1))
                    ->implode('');

                return [
                    'href' => route('folders.show', ['folder' => $folder->id], false),
                    'title' => $employeeName !== '' ? 'Dossier '.$employeeName : 'Dossier #'.$folder->id,
                    'meta' => $folder->employee?->employee_number ? 'Matricule : '.$folder->employee->employee_number : 'Dossier #'.$folder->id,
                    'badge' => 'Dossier',
                    'initials' => $initials !== '' ? mb_strtoupper($initials) : 'DO',
                ];
            });

        return view('search.global-results', [
            'query' => $query,
            'employeeResults' => $employeeResults,
            'folderResults' => $folderResults,
        ]);
    }

    private function applyEmployeeSearch(Builder $query, string $search): void
    {
        $normalizedSearch = mb_strtolower($search);
        $driver = DB::connection()->getDriverName();

        $query->where(function (Builder $builder) use ($normalizedSearch, $driver) {
            $builder
                ->whereRaw('LOWER(COALESCE(employee_number, \'\')) LIKE ?', ["%{$normalizedSearch}%"])
                ->orWhereRaw('LOWER(COALESCE(first_name, \'\')) LIKE ?', ["%{$normalizedSearch}%"])
                ->orWhereRaw('LOWER(COALESCE(last_name, \'\')) LIKE ?', ["%{$normalizedSearch}%"])
                ->orWhereRaw('LOWER(COALESCE(email, \'\')) LIKE ?', ["%{$normalizedSearch}%"]);

            if ($driver === 'sqlite') {
                $builder->orWhereRaw(
                    "LOWER(COALESCE(first_name, '') || ' ' || COALESCE(last_name, '')) LIKE ?",
                    ["%{$normalizedSearch}%"]
                );

                return;
            }

            $builder->orWhereRaw(
                "LOWER(CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))) LIKE ?",
                ["%{$normalizedSearch}%"]
            );
        });
    }

    private function applyFolderSearch(Builder $query, string $search): void
    {
        $normalizedSearch = mb_strtolower($search);
        $driver = DB::connection()->getDriverName();

        $query->where(function (Builder $builder) use ($normalizedSearch, $driver) {
            $builder->whereRaw(
                $driver === 'sqlite'
                    ? "LOWER(CAST(id AS TEXT)) LIKE ?"
                    : "LOWER(CAST(id AS CHAR)) LIKE ?",
                ["%{$normalizedSearch}%"]
            );

            $builder->orWhereHas('employee', function (Builder $employeeQuery) use ($normalizedSearch, $driver) {
                $employeeQuery->where(function (Builder $nestedQuery) use ($normalizedSearch, $driver) {
                    $nestedQuery
                        ->whereRaw('LOWER(COALESCE(employee_number, \'\')) LIKE ?', ["%{$normalizedSearch}%"])
                        ->orWhereRaw('LOWER(COALESCE(first_name, \'\')) LIKE ?', ["%{$normalizedSearch}%"])
                        ->orWhereRaw('LOWER(COALESCE(last_name, \'\')) LIKE ?', ["%{$normalizedSearch}%"])
                        ->orWhereRaw('LOWER(COALESCE(email, \'\')) LIKE ?', ["%{$normalizedSearch}%"]);

                    if ($driver === 'sqlite') {
                        $nestedQuery->orWhereRaw(
                            "LOWER(COALESCE(first_name, '') || ' ' || COALESCE(last_name, '')) LIKE ?",
                            ["%{$normalizedSearch}%"]
                        );

                        return;
                    }

                    $nestedQuery->orWhereRaw(
                        "LOWER(CONCAT(COALESCE(first_name, ''), ' ', COALESCE(last_name, ''))) LIKE ?",
                        ["%{$normalizedSearch}%"]
                    );
                });
            });
        });
    }
}
