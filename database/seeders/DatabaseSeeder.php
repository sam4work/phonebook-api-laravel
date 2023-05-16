<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
//         \App\Models\Contact::factory(15)->create();
//         \App\Models\PhoneNumber::factory(15)->create();

         \App\Models\User::factory()->create([
             'name' => 'Sam4Work',
             'email' => 'sam4work10@gmail.com',
             'password' => Hash::make('sam4work10@gmail.com'),
         ]);
    }
}
