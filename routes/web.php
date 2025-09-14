<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesignController;

Route::get('/', function () {
    return view('designer');
});

Route::post('/generate-design', [DesignController::class, 'generate']);
Route::post('/request-quote', [DesignController::class, 'sendQuoteRequest']);