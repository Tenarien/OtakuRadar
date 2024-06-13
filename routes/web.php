<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;

Route::get('/', [MangaController::class, 'index']);

Route::resource('mangas', MangaController::class);
Route::resource('chapters', MangaController::class);

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/mangas/{manga}/follow', [MangaController::class, 'follow'])->name('mangas.follow');
    Route::post('/mangas/{manga}/unfollow', [MangaController::class, 'unfollow'])->name('mangas.unfollow');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
