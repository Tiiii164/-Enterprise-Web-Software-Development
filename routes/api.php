<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('/v1/auth')->group( function(){
    Route::post('Register','register');
    Route::post('Login','login');
    Route::get('StaffProfile','showProfile');
});

