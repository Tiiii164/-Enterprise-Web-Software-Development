<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\UserController;
use App\Models\Categories;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DepartmentsController;

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('app');
});

Auth::routes();

Route::get('/home', [Controller::class, 'showHome'])->name('home');
Route::get('/Statistics', [Controller::class, 'showStatistics'])->name('Statistics');
Route::get('/StaffSubmission', [Controller::class, 'showStaffSubmission'])->name('StaffSubmission');

//User
Route::get('/getCurrentUser', function () {
    return Auth::user()->load('roles')
                       ->load('permissions')
                       ->load('departments');
});

Route::get('/signup', [AuthController::class, 'showFormSignUp']);
Route::post('signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/signin', [AuthController::class, 'showFormSignIn']);
Route::post('signin', [AuthController::class, 'signin'])->name('signin');
Route::match(['get', 'post'], '/logout', [AuthController::class, 'logout'])->name('logout');

//Profile
Route::get('/ShowProfile', [AuthController::class, 'showProfile'])->name('show-profile');
Route::post('/ChangePassword', [UserController::class, 'showChangePassword']);

//Department
Route::get('/DepartmentsIndex', [DepartmentsController::class, 'showDepartments']);
Route::get('/DepartmentsCreate', [DepartmentsController::class, 'showDepartmentsCreate']);
Route::get('/DepartmentsUpdate/{id}', [DepartmentsController::class, 'showDepartmentsUpdate']);

//Category
Route::get('/CategoriesIndex', [CategoriesController::class, 'showCategories']);
Route::get('/CategoriesCreate', [CategoriesController::class, 'showCategoriesCreate']);
Route::get('/CategoriesUpdate/{id}', [CategoriesController::class, 'showCategoriesUpdate']);

//Topics
Route::get('/TopicsIndex', [TopicsController::class, 'showTopics']);
Route::get('/TopicsCreate', [TopicsController::class, 'showTopicsCreate']);
Route::get('/TopicsUpdate/{id}', [TopicsController::class, 'showTopicsUpdate']);
Route::get('/TopicsShow/{id}', [TopicsController::class, 'showTopicsShow']);

//Ideas
Route::get('/IdeasIndex', [IdeasController::class, 'showIdeas']);
Route::get('/IdeasCreate', [IdeasController::class, 'showIdeasCreate']);
Route::get('/IdeasUpdate/{id}', [IdeasController::class, 'showIdeasUpdate']);
Route::get('/IdeasShow/{id}', [IdeasController::class, 'showIdeasShow']);
//Role
Route::get('/RolesIndex', [RolesController::class, 'showRoles']);
Route::get('/RolesCreate', [RolesController::class, 'showRolesCreate']);
Route::get('/RolesUpdate/{id}', [RolesController::class, 'showRolesUpdate']);

//User
Route::get('/UsersIndex', [UserController::class, 'showUsers']);
Route::get('/UsersCreate', [UserController::class, 'showUsersCreate']);
Route::get('/UsersUpdate/{id}', [UserController::class, 'showUsersUpdate']);