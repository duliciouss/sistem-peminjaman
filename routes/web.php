<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemLoanController;
use App\Http\Controllers\ItemReturnController;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    $stats = [
        'totalLoans' => DB::select('SELECT GetTotalLoans() AS total')[0]->total,
        'returnedLoans' => DB::select('SELECT GetReturnedLoans() AS total')[0]->total,
        'unreturnedLoans' => DB::select('SELECT GetUnreturnedLoans() AS total')[0]->total,
    ];
    $totalBarang = Item::count();
    $unavailable = Item::where('status', 'unavailable')->count();
    $available = Item::where('status', 'available')->count();
    return view('dashboard', compact('stats', 'totalBarang', 'unavailable', 'available'));
})->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('item-loans', ItemLoanController::class);
Route::resource('item-returns', ItemReturnController::class);
