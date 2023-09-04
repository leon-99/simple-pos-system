<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create([
            'email' => 'leonzifer@gmail.com',
            'password' => 'password'
        ]);

        \App\Models\Sale::factory(10)->create();

        \App\Models\Sale::factory(10)->create([
            'created_at' => Carbon::now()->subDays(1)
        ]);

        \App\Models\Sale::factory(10)->create([
            'created_at' => Carbon::now()->subMonths(1)
        ]);
    }
}
