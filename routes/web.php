<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Team Routes
    Route::resource('team', TeamController::class);
    Route::put('/team/{team}/join/{user}', [TeamController::class, 'join_user'])->name('team.join_user');
    Route::delete('/team/user/{id}/leave', [TeamController::class, 'leave_user'])->name('team.leave_user');
    // Task Routes
    Route::resource('task', TaskController::class);
    Route::put('/task/{task}/status', [TaskController::class, 'changeStatus'])->name('task.change_status');
    Route::post('/task/{task}/attachment', [TaskController::class, 'uploadAttachment'])->name('task.uploadAttachments');
    Route::get('/task-search', [TaskController::class, 'search'])->name('task.search');
    Route::resource('comment', CommentController::class)->except(['show']);
});

require __DIR__.'/auth.php';
