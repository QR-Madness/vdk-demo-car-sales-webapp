<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn () => Inertia::render('Home', ['message' => 'Welcome']));
Route::get('/about', fn () => Inertia::render('About'));

// Car CRUD routes
Route::resource('cars', CarController::class);
