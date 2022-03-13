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
        $this->truncateTables();

        collect(['KFC', 'Taco Bell', 'Pizza Hut', 'The Habit Burger Grill'])
            ->each(fn($name) => Brand::factory()->name($name)->create());

        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'email'    => 'test@yum.yum',
            'name'     => 'Mr Test',
            'password' => bcrypt('test-password'),
        ]);

        User::all()->each(function(User $user) {
            $stores = Store::factory()
                           ->has(Journal::factory()->count(3), 'journal')
                           ->count(3)
                           ->create();

            $user->addStores($stores);
        });
    }

    private function truncateTables()
    {
        $tables = [
            'store_user',
            'journals',
            'stores',
            'brands',
            'failed_jobs',
            'password_resets',
            'personal_access_tokens',
            'users',
        ];

        foreach ($tables as $table) {
            \DB::table($table)->delete();
        }
    }
}
