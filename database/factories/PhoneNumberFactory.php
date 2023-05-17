<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhoneNumber>
 */
class PhoneNumberFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{

		return [
			'contact_id' => Contact::factory(),
			'type' => fake()->randomElement(['mobile', 'landline',]),
			'sim_number' => fake()->e164PhoneNumber(),
		];
	}
}
