<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(2),
            'body' => $this->faker->sentence(),
            'is_public' => $this->faker->boolean(),
            'note_type_id' => $this->faker->numberBetween(1, 2),
            'user_id' => 1
        ];
    }
}
