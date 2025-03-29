<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\LecturerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;

Route::get('/', [LoginController::class, 'index'])->name('showLogin');
Route::post('/login', [LoginController::class, 'login'])->name('login-user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout-user');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/manage-course', [AdminController::class, 'showManageCourse'])->name('manage-course');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
});

// Lecturer routes
Route::prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'index'])->name('dashboard');
});

// Student routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
    Route::get('/assignment', [AssignmentController::class, 'index'])->name('assignment');

});