<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('notifications.index', [
            'notifications' => $user->notifications()->latest()->paginate(15),
        ]);
    }

    public function readAndRedirect(string $id)
    {
        $notification = auth()->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        $habitId = $notification->data['habit_id'] ?? null;

        return $habitId
            ? redirect()->route('habits.show', $habitId)
            : back();
    }
}
