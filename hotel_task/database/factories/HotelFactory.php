<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'location' => "{$this->faker->city()}, {$this->faker->state()}",
            'rating' => $this->faker->randomFloat(2, 0, 5),
            'image_path' => 'https://picsum.photos/seed/' . random_int(1, 1000) . '/640/480',

            // This is not working, DNS Issues
            // 'image_path' => $this->faker->imageUrl(640, 480, category:'hotel')
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Hotel $hotel) {
            Room::factory()->count(random_int(5, 10))->create([
                'hotel_id' => $hotel->id,
            ]);
        });
    }
}
