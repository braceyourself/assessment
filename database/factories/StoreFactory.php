<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $brands = Brand::query()->count() ? Brand::all() : Brand::factory()->count(5)->create();

        return [
            'brand_id' => $this->faker->randomElement($brands->pluck('id')),
            'number'   => $this->faker->randomNumber(5),
            'address'  => $this->faker->streetAddress,
            'city'     => $this->faker->city,
            'state'    => $this->faker->randomElement(['TX', 'CA', 'MI']),
            'zip_code' => $this->faker->postcode,
        ];
    }

    public function brand(Brand $brand)
    {
        return $this->state([
            'brand_id' => $brand->id
        ]);
    }
}
