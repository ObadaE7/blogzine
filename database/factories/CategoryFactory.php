<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            'Technology',
            'Fashion',
            'Health And Wellness',
            'Travel',
            'Food And Cooking',
            'Home And Garden',
            'Sports And Fitness',
            'Business And Finance',
            'Arts And Entertainment',
            'Science And Nature',
        ];

        $name = $this->faker->unique()->randomElement($categories);
        $slug = str()->slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
