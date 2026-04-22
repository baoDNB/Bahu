<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
use App\Models\Url;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', function () {
    $urls = Url::latest()->get();
    return view('components.welcome', compact('urls'));
})->name('home');

Route::get('/links', [UrlController::class, 'index'])->middleware('auth')->name('links');

Route::post('/shorten', [UrlController::class, 'store'])->name('url.shorten');
Route::get('/{code}', [UrlController::class, 'redirect'])->name('url.redirect');