<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JournalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'       => $this->faker->dateTimeThisMonth(),
            'revenue'    => $rev = $this->faker->numberBetween(5000, 10000),
            'food_cost'  => $food_cost = $this->faker->numberBetween(250, 1000),
            'labor_cost' => $labor_cost = $this->faker->numberBetween(250, 1000),
            'profit'     => $rev - $food_cost - $labor_cost,
        ];
    }
}
