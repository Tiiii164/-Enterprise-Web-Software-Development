<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\TopicsController;

use App\Models\Categories;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DepartmentsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/create', [IdeasController::class, 'create']);
Route::get('/index', [CategoriesController::class, 'index']);
Route::get('/create', [CategoriesController::class, 'create']);
Route::resource('categories', CategoriesController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/create', [IdeasController::class, 'create']);
Route::get('/categoryindex', [CategoriesController::class, 'index']);

Route::resource('/departments', DepartmentsController::class);

Route::resource('/topics', TopicsController::class);

Route::get('register', [AuthController::class, 'showFormRegister'])->name('show-form-register');
Route::post('register', [AuthController::class, 'register'])->name('register');

Route::get('login', [AuthController::class, 'showFormLogin'])->name('show-form-login');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('profile', [AuthController::class, 'showProfile'])->name('show-profile');
Route::put('profile', [AuthController::class, 'profile'])->name('profile');

Route::get('admin', [AdminController::class, 'adminPage'])->name('showAdminPage');

Route::resource('roles', RolesController::class);