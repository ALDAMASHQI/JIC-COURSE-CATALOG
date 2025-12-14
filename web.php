<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\ProfileController as SProfileController;
use App\Http\Controllers\Admin\RatingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\MajorController as AdminMajorController;
use App\Http\Controllers\MajorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('/majors/{id}', [MajorController::class, 'show'])->name('majors.show');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Protected Student Routes
Route::middleware(['auth'])->group(function () {
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/courses/{id}/rate', [CourseController::class, 'rate'])->name('courses.rate');
    // Profile Routes
    Route::get('/profile', [SProfileController::class, 'show'])->name('student.profile');
    Route::put('/profile', [SProfileController::class, 'update'])->name('student.profile.update');
    Route::delete('/ratings/{courseId}', [SProfileController::class, 'deleteRating'])->name('student.rating.delete');
});

// Protected Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('courses', AdminCourseController::class);
    Route::resource('students', StudentController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('majors', AdminMajorController::class);

    Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');
    Route::put('/ratings/{student}/{course}', [RatingController::class, 'update'])->name('ratings.update');
    Route::delete('/ratings/{student}/{course}', [RatingController::class, 'destroy'])->name('ratings.destroy');
    Route::delete('/ratings/bulk-delete', [RatingController::class, 'bulkDelete'])->name('ratings.bulk-delete');

});
