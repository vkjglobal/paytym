<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'company' => fake()->company(),
            'branch' => fake()->company(),
            'email' => fake()->unique()->safeEmail(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date(),
            'street' => fake()->streetName(),
            'city' => fake()->city(),
            'town' => fake()->city(),
            'postcode' => fake()->postcode(),
            'country' => fake()->country(),
            'tin' => fake()->numberBetween(10, 9999),
            'fnpf' => fake()->regexify('[A-Z]{5}[0-4]{3}'),
            'bank' => fake()->name(),
            'account_number' => fake()->randomNumber(),
            'isFirst' => fake()->numberBetween(0,1  ),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
