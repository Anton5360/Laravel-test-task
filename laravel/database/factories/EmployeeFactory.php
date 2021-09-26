<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $departments = Department::all()->pluck('id')->toArray();
        return [
            'department_id' => $this->faker->randomElement($departments),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->name(),
            'birthdate' => $this->faker->dateTimeBetween('-50 years', '-18 years'),
            'position' => $this->faker->randomElement(['tester', 'developer', 'UI/UX designer', 'HR']),
            'salary_type' => $this->faker->randomElement(['hourly', 'monthly']),
            'salary' => $this->faker->randomFloat(8, 1000, 5000)
        ];
    }
}
