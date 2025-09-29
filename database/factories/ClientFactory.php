<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'business_name' => $this->faker->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'monthly_rate' => $this->faker->randomFloat(2, 1000, 5000),
            'notes' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'recurring' => $this->faker->boolean(),
        ];
    }
}
