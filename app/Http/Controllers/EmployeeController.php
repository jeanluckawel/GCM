<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $employeesQuery = Employee::query();

        if ($search !== '') {
            $this->applySearchFilter($employeesQuery, $search);
        }

        $employees = $employeesQuery->get();

        return view('employees.index', compact('employees', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'employee_number' => ['required', 'string', 'max:255', 'unique:employees,employee_number'],
            'last_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female'],
            'birth_date' => ['required', 'date'],
            'status' => ['required', 'in:active,retired,suspended'],
            'position' => ['nullable', 'string', 'max:255'],
            'grade' => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'hire_date' => ['nullable', 'date'],
            'retirement_date' => ['nullable', 'date'],
        ]);

        Employee::unguarded(function () use ($validated) {
            Employee::create($validated);
        });

        return redirect()
            ->route('employee.index')
            ->with('success', 'L’employé a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function search(Request $request)
    {
        $search = trim((string) $request->query('q', ''));

        if (mb_strlen($search) < 2) {
            return response()->json([
                'results' => [],
            ]);
        }

        $employees = Employee::query()
            ->with('folder')
            ->whereHas('folder')
            ->when($search !== '', function (Builder $query) use ($search) {
                $this->applySearchFilter($query, $search);
            })
            ->limit(8)
            ->get();

        return response()->json([
            'results' => $employees->map(function (Employee $employee) {
                $fullName = $employee->full_name;
                $initials = collect(explode(' ', (string) $fullName))
                    ->filter()
                    ->take(2)
                    ->map(fn ($part) => mb_substr($part, 0, 1))
                    ->implode('');

                return [
                    'label' => $fullName,
                    'meta' => $employee->employee_number ?: null,
                    'href' => $employee->folder
                        ? route('folders.show', $employee->folder->id)
                        : null,
                    'initials' => $initials !== '' ? mb_strtoupper($initials) : 'EM',
                ];
            })->values(),
        ]);
    }

    private function applySearchFilter(Builder $query, string $search): void
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
}
