<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Folder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FolderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Employee::all()->each(function ($employee) {

            Folder::create([
                'employee_id' => $employee->id,
                'is_complete' => false,
                'remarks' => 'Employee folder created',
            ]);

        });
    }
}
