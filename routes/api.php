<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\CategoriesController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('/auth/')->group( function(){
    Route::post('Register','register');
    Route::post('Login','login');
});

Route::controller(RolesController::class)->group( function(){
    Route::get('/roles/RolesIndex', 'index');
    Route::get('/roles/edit/{id}', 'edit');
    Route::post('/roles/RolesCreate', 'store');
    Route::patch('/roles/RolesUpdate/{id}','update');
    Route::delete('/roles/delete/{id}', 'destroy');
});

Route::controller(CategoriesController::class)->group( function(){
    Route::get('/categories/CategoriesIndex', 'index');
    Route::get('/categories/edit/{id}', 'edit');
    Route::post('/categories/CategoriesCreate', 'store');
    Route::patch('/categories/CategoriesUpdate/{id}','update');
    Route::delete('/categories/delete/{id}', 'destroy');
});
// Route::get('StaffProfile','showProfile');