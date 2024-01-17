<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word,
            'slug' => fake()->slug,
            'image' => fake()->image,
            'content' => fake()->text,
            'user_id' => random_int(1, 10)
        ];
    }
}
