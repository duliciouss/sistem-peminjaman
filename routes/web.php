<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
Route::resource('items', ItemController::class);
