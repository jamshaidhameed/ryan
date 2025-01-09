<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'first_name' => str::random(6),
            'last_name' => str::random(5),
            'gender' => 'male',
            'company_name' =>str::random(10).' Company',
            'country_id' => 1,
            'province_id' => 1,
            'postcode' =>'0007852',
            'phone' => '45212547',
            'city' => 'test City',
            'street_address' => 'test Address',
            'email' => str::random(10).'@test.com',
            'role' => 'landlord',
            'password' => Hash::make('asdf'),
            'status' => 1
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
