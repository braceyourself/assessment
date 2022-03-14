<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => \Str::of($this->faker->lastName)->pluralStudly(),
            'color' => $this->faker->safeHexColor,
        ];
    }

    public function name($name)
    {
        return $this->state([
            'name' => $name
        ]);
    }
}
