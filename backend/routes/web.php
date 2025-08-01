<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home');

require __DIR__ . '/web_user.php';
