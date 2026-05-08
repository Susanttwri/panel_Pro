<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\QuizController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/courses', [FrontendController::class, 'courses'])->name('courses');
Route::get('/courses/{course}', [FrontendController::class, 'courseDetail'])->name('courses.show');
Route::get('/instructors', [FrontendController::class, 'instructors'])->name('instructors');

// Chat Routes
Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
Route::delete('/chat/{id}', [ChatController::class, 'destroy'])->name('chat.destroy');

// Quiz Route
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Panel Routes (Protected)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::resource('students', StudentController::class);
    Route::resource('instructors', InstructorController::class);
    Route::resource('enrollments', EnrollmentController::class)->except(['show']);
});
