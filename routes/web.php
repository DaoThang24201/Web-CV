<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layout.master');
})->name('welcome');

Route::get('/test', [TestController::class, 'test']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registering'])->name('registering');

Route::get('/auth/redirect/{provider}', [AuthController::class, 'redirect'])->name('auth.redirect');

Route::get('/auth/callback/{provider}', [AuthController::class, 'callback'])->name('auth.callback');
