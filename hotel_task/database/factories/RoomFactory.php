<?php

namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [        
            'hotel_id' => Hotel::inRandomOrder()->first()->id ?? Hotel::factory()->create()->id,
            'type' => $this->faker->randomElement(['single', 'double', 'triple', 'quad rooms']),
            'capacity' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->numberBetween(50, 500),
        ];
    }
}
