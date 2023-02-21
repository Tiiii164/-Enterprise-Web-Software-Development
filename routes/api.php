<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.auth')->get('/profile', 'AuthController@profile');


Route::controller(AuthController::class)->prefix('/auth/')->group(function () {
    Route::post('Register', 'register');
    Route::post('Login', 'login');
    Route::get('ShowProfile', 'profile')->name('show-profile');
    Route::put('UpdateProfile', 'updateProfile')->name('update-profile');
});

Route::controller(RolesController::class)->group(function () {
    Route::get('/roles/RolesIndex', 'index');
    Route::get('/roles/edit/{id}', 'edit');
    Route::post('/roles/RolesCreate', 'store');
    Route::patch('/roles/RolesUpdate/{id}', 'update');
    Route::delete('/roles/delete/{id}', 'destroy');
});

// Route::get('StaffProfile','showProfile');