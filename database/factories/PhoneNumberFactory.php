<?php

namespace Database\Factories;

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
        $contact_ids = [
            'f55034e4-f179-11ed-b667-c2172c977274',
            'f5504eac-f179-11ed-b667-c2172c977274'
        ];
        $types = ['mobile','landline',];
        return [
            //
            'contact_id' => fake()->randomElement($contact_ids),
            'type' => fake()->randomElement($types),
            'sim_number' => fake()->e164PhoneNumber(),
        ];
    }
}
