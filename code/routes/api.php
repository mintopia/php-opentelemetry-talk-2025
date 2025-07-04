<?php

use App\Http\Controllers\Api\QuoteController;
use Illuminate\Support\Facades\Route;

Route::apiResource('quotes', QuoteController::class);
