<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('login', [AuthController::class, 'showLogin'])->name('auth.login.show');
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('register', [AuthController::class, 'showRegister'])->name('auth.register.show');
Route::post('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
