<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\TopicsController;
use App\Models\Categories;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentsController;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('{any?}', function() {
    return view('welcome');
})->where('any', '.*')->middleware('auth');

Auth::routes();

Route::get('/', [Controller::class, 'showHome']);


Route::get('/register', [AuthController::class, 'showFormRegister']);
Route::post('register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showFormLogin']);
Route::post('login', [AuthController::class, 'login']);

Route::post('logout', [AuthController::class, 'logout']);


Route::get('/IdeasCreate', [IdeasController::class, 'create']);

Route::get('/CategoryIndex', [CategoriesController::class, 'index']);
Route::get('/CategoryCreate', [CategoriesController::class, 'create']);

Route::resource('/Departments', DepartmentsController::class);

//Route::resource('/Topics', TopicsController::class);

Route::get('/TopicsIndex', [TopicsController::class, 'showTopics']);
Route::get('/TopicsCreate', [TopicsController::class, 'showTopicsCreate']);
Route::get('/TopicsUpdate/{id}', [TopicsController::class, 'showTopicsUpdate']);

Route::get('/RolesIndex', [RolesController::class, 'showRoles']);
Route::get('/RolesCreate', [RolesController::class, 'showRolesCreate']);
Route::get('/RolesUpdate/{id}', [RolesController::class, 'showRolesUpdate']);


Route::get('profile', [AuthController::class, 'showProfile'])->name('show-profile');
Route::put('profile', [AuthController::class, 'profile'])->name('profile');

Route::get('/admin', [AdminController::class, 'adminPage'])->name('showAdminPage');
