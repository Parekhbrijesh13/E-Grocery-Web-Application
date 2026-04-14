<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, HomeController};

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

// Home Page Routes

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('home/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('home/about', [HomeController ::class, 'about'])->name('home.about');

// Auth Routes

Route::get('login', [AuthController::class, 'login'])->name('Auth.login');
Route::get('register', [AuthController::class, 'register'])->name('Auth.register');
Route::post('register/store', [AuthController::class, 'store'])->name('register.store');
