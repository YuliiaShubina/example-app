<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;

use Illuminate\Support\Facades\Route;

Route::get('/users/{user}', [UserController::class, 'show'])
->name('users.show');

Route::get('/', [HabitController::class, 'index'])
->name('home');

Route::get('/habits', [HabitController::class, 'index'])
->name('habits.index');

Route::middleware(['auth', 'verified'])->group(function () {

    
    Route::get('/dashboard', function () {
        return redirect()->route('home');
    })->name('dashboard');

    
    Route::get('/habits/create', [HabitController::class, 'create'])->name('habits.create');
    Route::post('/habits', [HabitController::class, 'store'])->name('habits.store');
    Route::get('/habits/{habit}/edit', [HabitController::class, 'edit'])->name('habits.edit');
    Route::put('/habits/{habit}', [HabitController::class, 'update'])->name('habits.update');
    Route::delete('/habits/{habit}', [HabitController::class, 'destroy'])->name('habits.destroy');

    
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'readAndRedirect'])
        ->name('notifications.read');
    
});

Route::post('/habits/{habit}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('habits.like');

Route::post('/habits/{habit}/comments', [CommentController::class, 'store'])
    ->middleware('auth')
    ->name('habits.comments.store');

Route::get('/habits/{habit}', [HabitController::class, 'show'])
->name('habits.show');
require __DIR__.'/auth.php';
