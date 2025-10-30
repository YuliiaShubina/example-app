<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class HabitFactory extends Factory
{
    public function definition()
    {
        $frequencies = ['daily', 'weekly', 'custom'];
        $goals = [
            'Drink 8 glasses of water',
            'Exercise 30 minutes',
            'Read for 20 minutes',
            'Walk 5,000 steps'
        ];

        return [
            // 'user_id' => User::factory(),
            'goal'      => fake()->randomElement($goals),
            'frequency' => fake()->randomElement($frequencies),
            'archived'  => false,
        ];
    }
}
