<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// About Routes
Route::controller(AboutController::class)->group(function () {
    Route::get('/about', 'index');
    Route::post('/about', 'store');
});

// Task Routes
Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks', 'index');
    Route::post('/create', 'store');
    Route::get('/tasks/edit/{id}', 'edit');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'destroy');
});

// User Routes
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index');
    Route::post('/create', 'store');
    Route::get('/users/edit/{id}', 'edit');
    Route::post('/update/{id}', 'update');
    Route::post('/delete/{id}', 'destroy');
});
