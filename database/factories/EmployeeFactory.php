<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;


    public function definition()
    {
        return [

            'employee_number' => 'EMP' . $this->faker->unique()->numberBetween(1000,9999),


            'last_name' => $this->faker->randomElement([
                'KABAMBA',
                'MULUMBA',
                'KASONGO',
                'ILUNGA',
                'MWAPE',
                'TSHIBANGU',
                'KALALA',
                'MUKENDI'
            ]),


            'middle_name' => $this->faker->randomElement([
                'Jean',
                'Patrick',
                'Christian',
                'Alain',
                'David'
            ]),


            'first_name' => $this->faker->randomElement([
                'Michel',
                'Grâce',
                'Paul',
                'Marie',
                'Joseph',
                'Kevin'
            ]),


            'gender' => $this->faker->randomElement([
                'male',
                'female'
            ]),


            'birth_date' => $this->faker->dateTimeBetween(
                '-55 years',
                '-25 years'
            ),


            'status' => $this->faker->randomElement([
                'active',
                'retired',
                'suspended',
            ]),


            'position' => $this->faker->randomElement([
                'Ingénieur Minier',
                'Géologue',
                'Technicien Maintenance',
                'Chef de Service',
                'Administrateur Système',
                'Comptable',
                'Agent Logistique'
            ]),


            'grade' => $this->faker->randomElement([
                'Cadre',
                'Chef de Service',
                'Agent Technique',
                'Expert',
                'Employé'
            ]),


            'department' => $this->faker->randomElement([
               'IT', 'HR', 'Mine', 'Marketing', 'Management'
            ]),


            'phone' => '+243' . $this->faker->numerify('#########'),


            'email' => $this->faker->unique()->userName().'@gecamines.cd',


            'address' => $this->faker->randomElement([
                'Lubumbashi',
                'Kolwezi',
                'Likasi',
                'Kipushi'
            ]),


            'hire_date' => $this->faker->dateTimeBetween(
                '-20 years',
                'now'
            ),


            'retirement_date' => null,


            'created_at' => now(),

            'updated_at' => now(),

        ];
    }
}
