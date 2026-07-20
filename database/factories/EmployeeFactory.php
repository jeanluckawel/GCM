<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EmployeeFactory extends Factory{
    protected $model = Employee::class;

    public function definition()
    {
        return [
            'employee_number' => $this->faker->word(),//
'last_name' => $this->faker->lastName(),
'middle_name' => $this->faker->name(),
'first_name' => $this->faker->firstName(),
'gender' => $this->faker->word(),
'birth_date' => Carbon::now(),
'status' => $this->faker->word(),
'position' => $this->faker->word(),
'grade' => $this->faker->word(),
'department_id' => $this->faker->randomNumber(),
'phone' => $this->faker->phoneNumber(),
'email' => $this->faker->unique()->safeEmail(),
'address' => $this->faker->address(),
'hire_date' => Carbon::now(),
'retirement_date' => Carbon::now(),
'created_at' => Carbon::now(),
'updated_at' => Carbon::now(),
        ];
    }
}
