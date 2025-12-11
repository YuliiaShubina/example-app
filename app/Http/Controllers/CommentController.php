<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Habit;
use App\Notifications\HabitInteracted;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
     public function store(Request $request, Habit $habit)
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // AJAX logic implented
        $comment = new Comment();
        $comment->body = $data['body'];
        $comment->user_id = auth()->id();
        $comment->habit_id = $habit->id;
        $comment->save();

        // notification
        if ($habit->user_id !== Auth::id()) {
            $habit->user->notify(
                new HabitInteracted(
                    Auth::user(),   
                    $habit,         
                    'comment',      
                    $comment        
        )
    );
}

        if ($request->wantsJson()) {
        $comment->load('user');

            return response()->json([
            'id'            => $comment->id,
            'body'          => $comment->body,
            'user_name'     => $comment->user->name,
            'created_at'    => $comment->created_at->toDateTimeString(),
            'created_human' => $comment->created_at->diffForHumans(),
        ]);
    }

        return back()->with('success', 'Comment added.');
    }

    // edit comment (owner or admin/moderator via policy)
    public function edit(Comment $comment){
        $this->authorize('update', $comment);

        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment){
        $this->authorize('update', $comment);

        $data = $request->validate([
            'body' => 'required|string|max:500',
        ]);

        $comment->update($data);

        return redirect()
            ->route('habits.show', $comment->habit_id)
            ->with('success', 'Comment updated.');
    }

    // delete comment (owner or admin/moderator via policy)
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
