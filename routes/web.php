<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Livewire\AddMatch;
use App\Livewire\Admin;
use App\Livewire\EditMatch;
use App\Livewire\EditUser;
use App\Livewire\Matches;
use App\Livewire\Ranking;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', Ranking::class)->name('ranking');
    Route::get('/matches', Matches::class)->name('matches');
    Route::get('/add/match', AddMatch::class)->name('add.match');
});

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/edit/match/{match}', EditMatch::class)->name('edit.match');
    Route::get('/admin', Admin::class)->name('admin');
    Route::get('/edit/user/{userId}', EditUser::class)->name('edit.user');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
