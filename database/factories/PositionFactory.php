<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $positions = ['Programmer' , 'Designer' , 'Accountant' , 'Customers Service'];
        $salaries  = [10000,5000,3500,7000];
        $departments = Department::pluck('id')->toArray();

        return [
            'name' => fake()->randomElement($positions),
            'description' => fake()->sentence(),
            'salary' => fake()->randomElement($salaries),
            'department_id' => fake()->randomElement($departments)
        ];
    }
}
