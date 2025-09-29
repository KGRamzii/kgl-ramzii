<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => \App\Models\Client::factory(),
            'invoice_number' => $this->faker->unique()->numerify('INV-####'),
            'date_start' => $this->faker->dateTimeBetween('-2 months', 'now'),
            'date_end' => $this->faker->dateTimeBetween('now', '+1 month'),
            'due_date' => $this->faker->dateTimeBetween('now', '+2 months'),
            'total_amount' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement(['sent', 'paid', 'overdue']),
        ];
    }
}
