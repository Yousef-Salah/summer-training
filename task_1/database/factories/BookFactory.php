<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::pluck('id');

        return [
            'title' => fake()->sentence(3),
            'author_id' => $users->random(),
            'number_of_pages' => fake()->numberBetween(50, 1000),
            'release_date' => fake()->date,
        ];
    }
}
