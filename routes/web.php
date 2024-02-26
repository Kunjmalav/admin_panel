<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserprofileController;
use App\Http\Controllers\DashboardController;
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




 

Route::get('/', [UserprofileController::class, 'showSignupForm'])->name('signup.form');
Route::post('/signup', [UserprofileController::class, 'signup'])->name('signup');
Route::get('/login', [UserprofileController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserprofileController::class, 'login'])->name('login');

Route::middleware(['auth:userprofiles'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [UserprofileController::class, 'logout'])->name('logout');
});
