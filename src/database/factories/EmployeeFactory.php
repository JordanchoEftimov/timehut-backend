<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'surname' => fake()->name,
            'phone' => fake()->phoneNumber,
            'address' => fake()->address,
            'employment_date' => fake()->dateTime,
            'email' => fake()->email,
            'company_id' => Company::query()->first(),
            'user_id' => User::query()->first(),
        ];
    }
}
