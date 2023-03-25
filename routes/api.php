<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\ReactsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Comments;
use App\Models\User;
use App\Models\Departments;

//Custom function
Route::get('/ShowProfile', function () {
    return Auth::user()->load('roles')
                        ->load('permissions')
                        ->load('departments')
                        ->load('ideas');
});

Route::get('/api/roles/RolesIndex', function () {
    $roles = Role::table('roles')->get();
    return response()->json($roles);
});
//UserController
Route::controller(UserController::class)->group(function () {
    Route::patch('/UpdateProfile/{id}', 'update');
    Route::post('/ChangePassword', 'changePassword');
});


//AuthController
Route::controller(AuthController::class)->prefix('/auth/')->group(function () {
    Route::post('signup', 'signup');
    Route::post('signin', 'signin');
});

//topics
Route::controller(TopicsController::class)->group(function () {
    Route::get('/topics', 'getTopics');
    Route::get('/topics/TopicsIndex', 'index');
    Route::get('/topics/edit/{id}', 'edit');
    Route::get('/topics/TopicsShow/{id}', 'inforTopics');
    Route::post('/topics/TopicsCreate', 'store');
    Route::patch('/topics/TopicsUpdate/{id}', 'update');
    Route::delete('/topics/delete/{id}', 'destroy');
});
//comments
Route::controller(CommentsController::class)->group(function () {
    Route::post('/ideas/IdeasShow/{id}', 'store');
});

//Ideas
Route::controller(IdeasController::class)->group(function () {
    Route::get('ideas', 'countIdeas');
    Route::get('/ideas/IdeasIndex', 'index');
    Route::get('/ideas/edit/{id}', 'edit');
    Route::get('/ideas/IdeasShow/{id}', 'inforIdeas');
    Route::post('/ideas/IdeasCreate', 'store');
    Route::patch('/ideas/IdeasUpdate/{id}', 'update');
    Route::delete('/ideas/delete/{id}', 'destroy');
});

//Reacts
Route::controller(ReactsController::class)->group(function () {
    Route::post('/like/{ideasId}', 'like');
    Route::post('/dislike/{ideasId}', 'dislike');
});

//Views
Route::post('/view/{ideasId}', [ViewsController::class, 'view']);

//RolesController
Route::controller(RolesController::class)->group(function () {
    Route::get('roles', 'count');
    Route::get('/roles/RolesIndex', 'index');
    Route::get('/roles/edit/{id}', 'edit');
    Route::post('/roles/RolesCreate', 'store');
    Route::patch('/roles/RolesUpdate/{id}', 'update');
    Route::delete('/roles/delete/{id}', 'destroy');
});

//DepartmentsController
Route::controller(DepartmentsController::class)->group(function () {
    Route::get('departments', 'count');
    Route::get('/departments/DepartmentsIndex', 'index');
    Route::get('/departments/edit/{id}', 'edit');
    Route::post('/departments/DepartmentsCreate', 'store');
    Route::patch('/departments/DepartmentsUpdate/{id}', 'update');
    Route::delete('/departments/delete/{id}', 'destroy');
});

//CategoriesController
Route::controller(CategoriesController::class)->group(function () {
    Route::get('/categories', 'getCategories');
    Route::get('/categories/CategoriesIndex', 'index');
    Route::get('/categories/edit/{id}', 'edit');
    Route::post('/categories/CategoriesCreate', 'store');
    Route::patch('/categories/CategoriesUpdate/{id}', 'update');
    Route::delete('/categories/delete/{id}', 'destroy');
});
//UsersController
Route::controller(UserController::class)->group(function () {
    Route::get('user', 'count');
    Route::get('/user/UsersIndex', 'index');
    Route::get('/user/edit/{id}', 'edit');
    Route::get('/user/UsersShow/{id}', 'inforUsers');
    Route::post('/user/UsersCreate', 'store');
    Route::patch('/user/UsersUpdate/{id}', 'update');
    Route::delete('/user/delete/{id}', 'destroy');
});
