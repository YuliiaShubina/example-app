<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habit;
use App\Notifications\HabitInteracted;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Habit $habit)
    {
        $user = Auth::user();

        $likeQuery = $habit->likes()->where('user_id', $user->id);

        $alreadyLiked = $likeQuery->exists();

        if ($alreadyLiked) {
            // unlike
            $likeQuery->delete();
        } else {
            // like
            $habit->likes()->create([
                'user_id' => $user->id,
            ]);

            // send notification only on LIKE
            if ($habit->user_id !== $user->id) {
                $habit->user->notify(
                    new HabitInteracted(
                        $user,   
                        $habit,  
                        'like'   
                    )
                );
            }
        }
        return back();
    }
}
