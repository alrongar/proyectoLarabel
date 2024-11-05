<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Category;
use app\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\evento>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organizer_id' => 13, 
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'category' => $this->faker->randomElement(['Music', 'Sport', 'Tech']),
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'location' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'max_attendees' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'image_url' => $this->faker->imageUrl(),
            'deleted' => 0,
        ];
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
