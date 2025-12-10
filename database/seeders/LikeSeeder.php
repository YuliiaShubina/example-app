<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Habit;
use App\Models\Like;
use App\Models\User;



class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $habits = Habit::all();

        foreach ($users as $user) {

            if ($habits->count() === 0) {
                continue;
            }
            
            $randomHabits = $habits->random(
                min($habits->count(), rand(1, 25)));

            foreach ($randomHabits as $habit) {
                $habit->likes()->firstOrCreate([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}

