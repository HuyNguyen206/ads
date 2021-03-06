<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::factory()->create([
            'email' => 'nguyenlehuyuit@gmail.com'
        ]);
        User::factory()->create([
            'email' => 'admin@gmail.com',
            'is_admin' => true
        ]);
         \App\Models\User::factory(3)->create();
         $this->call(CategorySeeder::class);
         $this->call(CountrySeeder::class);
         $this->call(StateSeeder::class);
         $this->call(CitySeeder::class);
    }
}
