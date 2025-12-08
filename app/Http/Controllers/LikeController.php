<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;

class LikeController extends Controller
{
    public function toggle(Habit $habit)
    {
        $user = auth()->user();

        $alreadyLiked = $habit->likes()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyLiked) {
            // unlike
            $habit->likes()->where('user_id', $user->id)->delete();
        } else {
            // like
            $habit->likes()->create([
                'user_id' => $user->id,
            ]);
        }

        return back();
    }
}
