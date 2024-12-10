<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $salaries  = [10000,5000,3500,7000];
        return [
            'first_name' => fake()->name('male'),
            'last_name' => fake()->name('male'),
            'email' =>fake()->email(),
            'phone' => fake()->phoneNumber(),
            'status' => fake()->randomElement(["active","inactive"]),
            'salary' => fake()->randomElement($salaries),
            'hired_at' => fake()->date(),
            'department_id' => fake()->randomElement(Department::pluck('id')->toArray()),
            'position_id' => fake()->randomElement(Position::pluck('id')->toArray())
        ];
    }
}
