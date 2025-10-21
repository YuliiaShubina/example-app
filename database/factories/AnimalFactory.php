<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory {
    public function definition()
    {
        $types = ['dog', 'cat', 'bird', 'lizard', 'fish', 'elephant', 'snake'];
        $coverings = ['fur', 'feathers', 'scales', 'skin'];
        return[
            'type' => fake()->randomElement($types),
            'covering' => fake()->randomElement($coverings),
            'legs' => fake()->numberBetween(0,8),];
    }
}