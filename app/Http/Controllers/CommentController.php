<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Habit;

class CommentController extends Controller
{
     public function store(Request $request, Habit $habit)
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'habit_id' => $habit->id,
            'user_id'  => auth()->id(),
            'body'     => $data['body'],
        ]);

        return back()->with('success', 'Comment added.');
    }

    // delete comment (owner or admin/moderator via policy)
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
