<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\topicsController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('/auth/')->group( function(){
    Route::post('signup','signup');
    Route::post('signin','signin');
});

Route::controller(TopicsController::class)->group(function () {
    Route::get('/topics/TopicsIndex', 'index');
    Route::get('/topics/edit/{id}', 'edit');
    Route::post('/topics/TopicsCreate', 'store');
    Route::patch('/topics/TopicsUpdate/{id}', 'update');
    Route::delete('/topics/delete/{id}', 'destroy');
});

Route::middleware('jwt.auth')->get('/profile', 'AuthController@profile');

Route::middleware('auth:api')->get('/auth/ShowProfile', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->prefix('/auth/')->group(function () {
    Route::get('ShowProfile', 'profile');
    Route::put('UpdateProfile', 'updateProfile')->name('update-profile');
});

Route::controller(RolesController::class)->group(function () {
    Route::get('/roles/RolesIndex', 'index');
    Route::get('/roles/edit/{id}', 'edit');
    Route::post('/roles/RolesCreate', 'store');
    Route::patch('/roles/RolesUpdate/{id}', 'update');
    Route::delete('/roles/delete/{id}', 'destroy');
});

Route::controller(DepartmentsController::class)->group( function(){
    Route::get('/departments/DepartmentsIndex', 'index');
    Route::get('/departments/edit/{id}', 'edit');
    Route::post('/departments/DepartmentsCreate', 'store');
    Route::patch('/departments/DepartmentsUpdate/{id}','update');
    Route::delete('/departments/delete/{id}', 'destroy');
});

Route::controller(CategoriesController::class)->group( function(){
    Route::get('/categories/CategoriesIndex', 'index');
    Route::get('/categories/edit/{id}', 'edit');
    Route::post('/categories/CategoriesCreate', 'store');
    Route::patch('/categories/CategoriesUpdate/{id}','update');
    Route::delete('/categories/delete/{id}', 'destroy');
});
// Route::get('StaffProfile','showProfile');
