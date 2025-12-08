<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HabitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HabitController::class, 'index'])
->name('home');

Route::get('/habits', [HabitController::class, 'index'])
->name('habits.index');
Route::get('/habits/{habit}', [HabitController::class, 'show'])
->name('habits.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
