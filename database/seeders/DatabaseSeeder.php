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
         \App\Models\User::factory(3)->create();
         $this->call(CategorySeeder::class);
    }
}