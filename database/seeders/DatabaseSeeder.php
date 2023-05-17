<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use \App\Models\User;
use \App\Models\Contact;

class DatabaseSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{

		$user = User::factory()->create([
			'first_name' => 'Demo',
			'last_name' => 'User',
			'email' => 'demo@example.com',
			'password' => Hash::make('password'),
		]);

		Contact::factory(15)
			->hasPhoneNumbers(1)
			->for($user)
			->create();
	}
}
