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

Auth::routes();

Route::get('/', [Controller::class, 'showHome']);

Route::middleware('auth')->group(function () {
    Route::get('/Register', [AuthController::class, 'showFormRegister'])->name('show-form-register');
    Route::post('register', [AuthController::class, 'register'])->name('register');

    Route::get('/Login', [AuthController::class, 'showFormLogin'])->name('show-form-login');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/IdeasCreate', [IdeasController::class, 'create']);

Route::get('/CategoriesIndex', [CategoriesController::class, 'showCategories']);
Route::get('/CategoriesCreate', [CategoriesController::class, 'showCategoriesCreate']);
Route::get('/CategoriesUpdate/{id}', [CategoriesController::class, 'showCategoriesUpdate']);

Route::resource('/Departments', DepartmentsController::class);

Route::resource('/Topics', TopicsController::class);

Route::get('/RolesIndex', [RolesController::class, 'showRoles']);
Route::get('/RolesCreate', [RolesController::class, 'showRolesCreate']);
Route::get('/RolesUpdate/{id}', [RolesController::class, 'showRolesUpdate']);

Route::get('profile', [AuthController::class, 'showProfile'])->name('show-profile');
Route::put('profile', [AuthController::class, 'profile'])->name('profile');

Route::get('/admin', [AdminController::class, 'adminPage'])->name('showAdminPage');