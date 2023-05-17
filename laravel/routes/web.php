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
//auth
Route::get('/', [\App\Http\Controllers\CDM\PageController::class, 'home'])->name('home');
Route::get('/register', [\App\Http\Controllers\CDM\PageController::class, 'register'])->name('register');
Route::get('/login', [\App\Http\Controllers\CDM\PageController::class, 'login'])->name('login');

//static
Route::get('/about-us', [\App\Http\Controllers\CDM\PageController::class, 'about'])->name('about');
Route::get('/connect-with-us', [\App\Http\Controllers\CDM\PageController::class, 'connect'])->name('connect');
Route::get('/site/rules', [\App\Http\Controllers\CDM\PageController::class, 'rules'])->name('rules');

//dinamic
Route::get('/profile', [\App\Http\Controllers\CDM\PageController::class, 'profile'])->name('profile');
Route::get('/projects', [\App\Http\Controllers\CDM\PageController::class, 'projects'])->name('projects');
Route::get('/projects/create', [\App\Http\Controllers\CDM\PageController::class, 'projectCreate'])->name('projects.create');
Route::get('/projects/{slug}', [\App\Http\Controllers\CDM\PageController::class, 'project'])->name('project');
Route::get('/projects/{slug}/satellite-images/create', [\App\Http\Controllers\CDM\PageController::class, 'satelliteImageCreate'])->name('projects.images.create');


//routes
Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::post('/register', [\App\Http\Controllers\CDM\UserController::class, 'register'])->name('register');
    Route::post('/authenticate', [\App\Http\Controllers\CDM\UserController::class, 'authenticate'])->name('authenticate');
    Route::get('/logout', [\App\Http\Controllers\CDM\UserController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
    Route::group(['prefix' => 'projects', 'as' => 'projects.'], function () {
        Route::post('create', [\App\Http\Controllers\CDM\ProjectController::class, 'create'])->name('create');
        Route::post('update', [\App\Http\Controllers\CDM\ProjectController::class, 'update'])->name('update');
        Route::post('delete', [\App\Http\Controllers\CDM\ProjectController::class, 'delete'])->name('delete');
    });
});
