<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Journal;
use App\Models\Store;
use App\Models\User;
use Database\Factories\BrandFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        collect(['KFC', 'Taco Bell', 'Pizza Hut', 'The Habit Burger Grill'])
            ->each(fn($name) => Brand::factory()->name($name)->create());

        \App\Models\User::factory(10)->create()->each(function(User $user) {
            $stores = Store::factory()
                           ->has(Journal::factory()->count(3), 'journals')
                           ->count(3)
                           ->create();

            $user->addStores($stores);

        });
    }
}
