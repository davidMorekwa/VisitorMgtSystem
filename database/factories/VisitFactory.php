<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visit>
 */
class VisitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $visit_options = ["Make a complaint", "Accounts", "Delivery", "Personal Visit"];
        $purpose = $visit_options[$this->faker->numberBetween(0,3)];
        $time = $this->faker->dateTimeBetween('-5 years');
        $official_info = [
            'visitor_id' => $this->faker->numberBetween(1,100),
            'purpose_of_visit' => $purpose,
            'time_in' => $time,
        ];
        if ($official_info["purpose_of_visit"] == "Make a complaint" || $official_info["purpose_of_visit"] == "Accounts") {
            $official_info["sacco_id"] = $this->faker->numberBetween(1, 360);
        }
        if ($official_info["purpose_of_visit"] == "Delivery" || $official_info["purpose_of_visit"] == "Personal Visit") {
            $official_info["person_to_see"] = $this->faker->name();
        }
        return $official_info;
    }
}
