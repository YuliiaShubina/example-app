<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;


class HabitController extends Controller
{
     public function index()
    {
        $habits = Habit::with('user')
            ->withCount('comments', 'likes')
            ->latest()
            ->paginate(10);

        return view('habits.index', compact('habits'));
    }

    public function show(Habit $habit)
    {
        $habit->load([
            'user',
            'comments.user',
            'likes',
        ]);

        $likesCount = $habit->likes->count();

        $likedByAuthUser = auth()->check()
            ? $habit->likes->contains('user_id', auth()->id())
            : false;

        return view('habits.show', [
            'habit'           => $habit,
            'likesCount'      => $likesCount,
            'likedByAuthUser' => $likedByAuthUser,
        ]);
    }
}
