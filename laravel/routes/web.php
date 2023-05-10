<?php

use Illuminate\Support\Facades\Route;

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

//pages without frontend
Route::get('/', [\App\Http\Controllers\CDM\PageController::class, 'home'])->name('home');
Route::get('/register', [\App\Http\Controllers\CDM\PageController::class, 'register'])->name('register');
Route::get('/login', [\App\Http\Controllers\CDM\PageController::class, 'login'])->name('login');

Route::get('/site/rules', [\App\Http\Controllers\CDM\PageController::class, 'rules'])->name('rules');

//routes
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::post('/register', [\App\Http\Controllers\CDM\UserController::class, 'register'])->name('register');
    Route::post('/authenticate', [\App\Http\Controllers\CDM\UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [\App\Http\Controllers\CDM\UserController::class, 'logout'])->name('logout');
});
