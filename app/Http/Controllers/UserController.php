<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $habits = $user->habits()->latest()->paginate(10);
        $comments = $user->comment()->with('habit')->latest()->get();

        return view('users.show', compact('user', 'habits', 'comments'));
    }
}
