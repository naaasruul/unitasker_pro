<?php

use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LecturerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GroupTaskController;

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
    Route::patch('/{group}/todo/{task}', [GroupController::class, 'markTaskAsCompleted'])->name('todo.mark-completed'); // Mark a task as completed
});

// Personal To-Do List Routes
Route::prefix('tasks')->name('tasks.')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('index'); // View personal tasks
    Route::post('/', [TaskController::class, 'store'])->name('store'); // Add a new task
    Route::patch('/{task}', [TaskController::class, 'markAsCompleted'])->name('mark-completed'); // Mark task as completed
});

// Group To-Do List Routes
Route::prefix('group-tasks')->name('group-tasks.')->group(function () {
    Route::get('/{group}', [GroupTaskController::class, 'index'])->name('index'); // View group tasks
    Route::post('/{group}', [GroupTaskController::class, 'store'])->name('store'); // Add a new group task
    Route::patch('/{group}/{task}', [GroupTaskController::class, 'markAsCompleted'])->name('mark-completed'); // Mark group task as completed
});