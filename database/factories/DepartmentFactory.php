<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Department>
 */
class DepartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $department = ['IT Department' , 'Management Department' , 'Accounting Department' , 'Hr Department'];
        return [
            'name' => $department[rand(0,2)],
            'description' => $this->faker->title(),
        ];
    }
}
