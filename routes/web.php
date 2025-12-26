<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('team', TeamController::class);
    Route::put('/team/{team}/join/{user}', [TeamController::class, 'join_user'])->name('team.join_user');
    Route::delete('/team/user/{id}/leave', [TeamController::class, 'leave_user'])->name('team.leave_user');
    Route::resource('task', TaskController::class);
});

require __DIR__.'/auth.php';
