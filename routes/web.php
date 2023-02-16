<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', [AuthController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('register', [AuthController::class, 'showFormRegister'])->name('show-form-register');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showFormLogin'])->name('show-form-login');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile', [AuthController::class, 'showProfile'])->name('show-profile');
Route::put('profile', [AuthController::class, 'profile'])->name('profile');
