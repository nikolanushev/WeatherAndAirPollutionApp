<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/pollution', function () {
    return view('pollution');
});

Route::get('weather/{city?}', [CityController::class, 'index'])->name('search');;
