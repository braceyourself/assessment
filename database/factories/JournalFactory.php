<?php

namespace Database\Factories;

use App\Models\Store;
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
            'revenue'    => $rev = $this->faker->randomFloat(null, 5000, 10000),
            'food_cost'  => $food_cost = $this->faker->randomFloat(null, 250, 1000),
            'labor_cost' => $labor_cost = $this->faker->randomFloat(null, 250, 1000),
            'profit'     => $rev - $food_cost - $labor_cost,
        ];
    }

    public function forStore(Store $store)
    {
        return $this->state([
            'store_id' => $store->id
        ]);
    }
}
