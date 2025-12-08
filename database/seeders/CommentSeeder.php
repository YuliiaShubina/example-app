<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Habit;
use App\Models\Comment;



class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $habits = Habit::all();

        $numberOfComments = rand(0,40);

        foreach($habits as $habit){
            $numberOfComments = rand(0,40);

        for ($i = 0; $i < $numberOfComments; $i++) {
        Comment::factory()->create([
            'habit_id' => $habit->id,
            'user_id'  => $users->random()->id,
    ]);
    }
    }
}
}
