<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserTableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
       return [
            'first_name' => fake()->first_name(),
            'last_name' => fake()->last_name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'phone' => fake()->phoneNumber,
            'street_address' => fake()->address,
            'status' => fake()->randomElement([1,0]),
            'country_id' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'province_id' => fake()->randomElement([1,2,3,4,5,6,7,8,9,10]),
            'role' => fake()->randomElement(['admin','landlord','tenant','technision']),
            'gender' => fake()->randomElement(['male','female','other']),
            'postcode' => fake()->postcode
        ];
    }
}
