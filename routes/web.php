<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemLoanController;
use App\Http\Controllers\ItemReturnController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('item-loans', ItemLoanController::class);
Route::resource('item-returns', ItemReturnController::class);
