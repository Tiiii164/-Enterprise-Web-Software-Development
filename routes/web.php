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
    return view('home');
});

Auth::routes();

Route::get('/home', [Controller::class, 'showHome'])->name('home');

Route::get('/getCurrentUser', function() {
    return Auth::user()->load('roles');
 });

Route::get('/signup', [AuthController::class, 'showFormSignUp']);
Route::post('signup', [AuthController::class, 'signup'])->name('signup');

Route::get('/signin', [AuthController::class, 'showFormSignIn']);
Route::post('signin', [ AuthController::class, 'signin'])->name('signin');

Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/ShowProfile', [AuthController::class, 'showProfile'])->name('show-profile');
// Route::put('/UpdateProfile', [AuthController::class, 'updateProfile'])->name('update-profile');


//Route::resource('/Departments', DepartmentsController::class);
Route::get('/DepartmentsIndex', [DepartmentsController::class, 'showDepartments']);
Route::get('/DepartmentsCreate', [DepartmentsController::class, 'showDepartmentsCreate']);
Route::get('/DepartmentsUpdate/{id}', [DepartmentsController::class, 'showDepartmentsUpdate']);

//Route::resource('categories', CategoriesController::class);
Route::get('/CategoriesIndex', [CategoriesController::class, 'showCategories']);
Route::get('/CategoriesCreate', [CategoriesController::class, 'showCategoriesCreate']);
Route::get('/CategoriesUpdate/{id}', [CategoriesController::class, 'showCategoriesUpdate']);

// Route::resource('/Departments', DepartmentsController::class);

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

