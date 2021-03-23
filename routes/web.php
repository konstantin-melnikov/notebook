<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotebookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\MenuController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function() {
        Route::resource('/subscribers', SubscriberController::class);
        Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    });
    Route::get('/', [NotebookController::class, 'index'])->name('notebook');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'auth'])->name('auth');

Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'createUser'])->name('createUser');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');