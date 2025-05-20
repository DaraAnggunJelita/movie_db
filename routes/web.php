<?php

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
Route::get('home',[moviecontroller::class,'homepage']);
Route::get('movie/{id}/{slug}',[MovieController::class,'detail']);

