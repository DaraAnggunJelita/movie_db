<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman default
Route::get('/', function () {
    return view('welcome');
});



// Resource controller
Route::resource('movie', MovieController::class);
Route::resource('category', CategoryController::class);
Route::get('home',[moviecontroller::class,'homepage'])->name('home');
Route::get('movie/{id}/{slug}',[MovieController::class,'detail']);

Route::get('create-movie', [MovieController::class, 'createMovie'])->name('createMovies')->middleware('auth');


// Route menampilkan form login (GET)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');

// Route untuk proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
