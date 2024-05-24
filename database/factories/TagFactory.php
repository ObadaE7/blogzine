<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            'Tech News',
            'Fashion Trends',
            'Science Facts',
            'Healthy Living',
            'Travel Tips',
            'Foodie Friday',
            'Gardening',
            'Fitness Motivation',
            'Business Tips',
            'Artistic Expression',
        ];

        $name = $this->faker->unique()->randomElement($tags);
        $slug = str()->slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
