<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AdminFactory extends Factory
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
            'country_id' => Country::inRandomOrder()->first()->id,
            'uname' => $this->faker->unique()->userName,
            'fname' => $this->faker->firstName(),
            'lname' => $this->faker->lastName(),
            // 'bio' => $this->faker->paragraph(),
            // 'birthday' => $this->faker->date(),
            // 'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            // 'avatar' => $this->faker->imageUrl(width: 200, height: 200),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
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
