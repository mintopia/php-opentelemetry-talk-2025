<?php

use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QuoteController::class, 'home'])->name('home');
Route::get('/error', [QuoteController::class, 'error'])->name('error');
