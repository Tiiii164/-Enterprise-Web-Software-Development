<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\topicsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('/auth/')->group(function () {
    Route::post('Register', 'register');
    Route::post('Login', 'login');
});

Route::controller(TopicsController::class)->group(function () {
    Route::get('/topics/TopicsIndex', 'index');
    Route::get('/topics/edit/{id}', 'edit');
    Route::post('/topics/TopicsCreate', 'store');
    Route::patch('/topics/TopicsUpdate/{id}', 'update');
    Route::delete('/topics/delete/{id}', 'destroy');
});
Route::controller(RolesController::class)->group(function () {
    Route::get('/roles/RolesIndex', 'index');
    Route::get('/roles/edit/{id}', 'edit');
    Route::post('/roles/RolesCreate', 'store');
    Route::patch('/roles/RolesUpdate/{id}', 'update');
    Route::delete('/roles/delete/{id}', 'destroy');
});
// Route::get('StaffProfile','showProfile');