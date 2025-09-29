<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Web Development',
                'Mobile App Development',
                'UI/UX Design',
                'Logo Design',
                'SEO Optimization',
                'Content Writing',
                'Social Media Management',
                'Database Design',
                'API Development',
                'System Architecture',
                'Cloud Deployment',
                'Security Audit',
            ]),
            'description' => $this->faker->paragraph(),
            'default_price' => $this->faker->randomFloat(2, 50, 500),
            'active' => true,
        ];
    }

    /**
     * Indicate that the service is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'active' => false,
        ]);
    }
}
