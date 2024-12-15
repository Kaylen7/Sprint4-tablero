<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/games', function () {
    return view('games.index');
})->middleware(['auth', 'verified'])->name('games');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/notifications', [ProfileController::class, 'notifications'])->name('profile.notifications');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('games', GameController::class);
    Route::post('/games/join', [GameController::class, 'join'])->name('games.join');
    Route::post('games/leave', [GameController::class, 'leave'])->name('games.leave');
    Route::get('/friends', [FriendController::class, 'index'])->name('friends.index');
    Route::post('/friends', [FriendController::class, 'add'])->name('friends.add');
    Route::post('/friends/accept', [FriendController::class, 'accept'])->name('friends.accept');
    Route::delete('/friends', [FriendController::class, 'destroy'])->name('friends.destroy');
});

require __DIR__.'/auth.php';
