<?php

use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/shorten', [UrlController::class, 'store'])->name('url.shorten');

Route::get('/{code}', [UrlController::class, 'redirect'])->name('url.redirect');