<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AppController::class, 'home'])->name('home');
Route::get('/authors', [AppController::class, 'topAuthors']);
Route::get('/rating', [AppController::class, 'ratingForm'])->name('rating');
Route::post('/rating', [AppController::class, 'addRatings']);
Route::get('/author/{id}/books', [AppController::class, 'getBooksByAuthor']);
