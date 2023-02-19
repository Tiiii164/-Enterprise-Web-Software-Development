<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::controller(AuthController::class)->prefix('/auth/')->group( function(){
//     Route::post('Register','register');
//     Route::post('Login','login');
// });

// Route::get('StaffProfile','showProfile');

Route::post('/auth/Register', [AuthController::class, 'register']);
Route::post('/auth/Login', [AuthController::class, 'login']);

Route::get('/roles/RolesIndex', [RolesController::class, 'index']);
Route::get('/roles/edit/{id}', [RolesController::class, 'edit']);
Route::post('roles/RolesCreate', [RolesController::class, 'store']);
Route::put('roles/RolesUpdate/{id}', [RolesController::class, 'update']);
Route::delete('roles/delete/{id}', [RolesController::class, 'destroy']);
