<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout.master');
})->name('welcome');

/*Route::group([
    'as' => 'users.',
    'prefix' => 'users/'
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
    });*/

Route::prefix('users')->name('users.')->group(function () {

   Route::get('/', [UserController::class, 'index'])->name('index');

   Route::get('/{user}', [UserController::class, 'show'])->name('show');

   Route::post('/{user}', [UserController::class, 'destroy'])->name('destroy');

});

Route::prefix('posts')->name('posts.')->group(function () {

    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');

});

