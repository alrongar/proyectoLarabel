<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\Category;
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
            'name' => fake()->name(),
            'description' => $this->faker->text(200),
            'category' => $this->faker->randomElement(['Music', 'Sport', 'Tech']),
            'image'=>"",
            'user_id'=> \App\Models\User::factory(),
        ];
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
