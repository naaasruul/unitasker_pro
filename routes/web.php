<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LecturerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GroupTaskController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SkillController;


Route::get('/', [LoginController::class, 'index'])->name('showLogin');
Route::get('/forgot-password', [LoginController::class, 'showForgotPassword'])->name('showForgotPassword');
Route::post('/login', [LoginController::class, 'login'])->name('login-user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout-user');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// USER PROFILE
Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/user', [ProfileController::class, 'index'])->name('index');
    Route::put('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/enroll-course', [ProfileController::class, 'enroll'])->name('enroll');
    Route::delete('/unenroll/{course}', [ProfileController::class, 'unenroll'])->name('unenroll');
});

Route::prefix('course')->name('course.')->group(function () {
    Route::get('/', [EnrollmentController::class, 'index'])->name('index');
    Route::post('/enroll-course', [ProfileController::class, 'enroll'])->name('enroll');
    Route::delete('/unenroll/{course}', [ProfileController::class, 'unenroll'])->name('unenroll');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('students', AdminController::class);
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/manage-course', [AdminController::class, 'showManageCourse'])->name('manage-course');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('/manage-students', [AdminController::class, 'showManageStudents'])->name('manage-students');
    Route::get('/manage-lecturers', [AdminController::class, 'showManageLecturers'])->name('manage-lecturers');

    Route::post('/add-lecturers', [AdminController::class, 'storeLecturer'])->name('storeLecturer');
    Route::post('{id}/delete-lecturers', [AdminController::class, 'destroyLecturer'])->name('destroyLecturer');
    Route::put('{id}/update-lecturers', [AdminController::class, 'updateLecturer'])->name('updateLecturer');
});

// Lecturer routes
Route::prefix('lecturer')->name('lecturer.')->group(function () {
    Route::get('/dashboard', [LecturerController::class, 'index'])->name('dashboard');
    Route::post('/lecturer/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::get('/groups/{group}/chats', [ChatController::class, 'index'])->name('groups.chats');

});

// Student routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');;
    Route::get('/assignment', [AssignmentController::class, 'index'])->name('assignment');
    Route::post('/assignments', [AssignmentController::class, 'storeAssignment'])->name('assignments.store');

    Route::post('/student/groups/join', [StudentController::class, 'joinGroup'])->name('groups.join');
    Route::post('/assignments/{assignment}/tasks', [AssignmentController::class, 'storeTask'])->name('tasks.store');

    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');

});

// Chat Routes
Route::prefix('chat')->name('chat.')->group(function () {
    Route::get('/{group}', [ChatController::class, 'index'])->name('index'); // Specific chatroom
    Route::post('/{group}/send', [ChatController::class, 'send'])->name('send'); // Send message
    Route::get('/{group}/messages', [ChatController::class, 'fetchMessages'])->name('fetch-messages'); // Fetch messages
});

// Group To-Do List Routes
Route::prefix('group')->name('group.')->group(function () {
    Route::get('/{group}/todo', [GroupController::class, 'showToDoList'])->name('todo'); // Display the to-do list for a group
    Route::post('/{group}/todo', [GroupController::class, 'addTask'])->name('todo.add'); // Add a new task to the group
    // Route::patch('/{group}/todo/{task}', [GroupController::class, 'markTaskAsCompleted'])->name('todo.mark-completed'); // Mark a task as completed
    Route::patch('/{group}/{task}/status', [GroupTaskController::class, 'changeStatus'])->name('change-status');
});

// Personal To-Do List Routes
Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::post('/tasks', [TaskController::class, 'store'])->name('store');
    Route::get('/tasks/date', [TaskController::class, 'getTasksByDate'])->name('by-date');
    Route::get('/tasks/counts', [TaskController::class, 'getTaskCounts'])->name('counts');
});

// Group To-Do List Routes
Route::prefix('group-tasks')->name('group-tasks.')->group(function () {
    Route::get('/{group}', [GroupTaskController::class, 'index'])->name('index'); // View group tasks
    Route::post('/{group}', [GroupTaskController::class, 'store'])->name('store'); // Add a new group task
    Route::patch('/{group}/{task}', [GroupTaskController::class, 'markAsCompleted'])->name('mark-completed'); // Mark group task as completed
    Route::patch('/group/{group}/task/{task}/progress', [GroupTaskController::class, 'updateProgress'])->name('update-progress');
});