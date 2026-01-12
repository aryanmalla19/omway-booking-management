<?php

namespace Database\Factories;

use App\Enums\RoomStatus;
use App\Enums\RoomType;
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
            'room_type' => fake()->randomElement(array_column(RoomType::cases(), 'value')),
            'price_per_day' => fake()->numberBetween(1000,10000),
            'status' => fake()->randomElement(array_column(RoomStatus::cases(), 'value')),
            'description' => fake()->text(),
        ];
    }
}
