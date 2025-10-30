<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Habit;

class HabitTableSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $users->each(function (User $user) {
          Habit::factory(fake()->numberBetween(3,6))->create([
            'user_id'=> $user->id,
          ]);
        });
    }
}