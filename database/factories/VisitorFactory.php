<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "ID/Passport_number" => $this->faker->numberBetween(1, 100),
            "name" => $this->faker->name(),
            "phone_number" => $this->faker->phoneNumber(),
            "email" => $this->faker->email()
        ];
    }
}
