<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ValidationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;

Route::get('/', [MangaController::class, 'index']);

Route::resource('mangas', MangaController::class);
Route::resource('chapters', MangaController::class);

Route::get('/search', [MangaController::class, 'search'])->name('mangas.search');

Route::get('/random', [MangaController::class, 'random'])->name('mangas.random');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/mangas/{manga}/follow', [MangaController::class, 'follow'])->name('mangas.follow');
    Route::post('/mangas/{manga}/unfollow', [MangaController::class, 'unfollow'])->name('mangas.unfollow');

    Route::get('/bookmarks', [BookmarkController::class, 'bookmark'])->name('users.bookmark');

    Route::post('/logview', [MangaController::class, 'logView'])->name('users.logview');
});

Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});
