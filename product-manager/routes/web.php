<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Student\AuthController as StudentAuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;
use App\Http\Controllers\Student\EnrollmentController as StudentEnrollmentController;
use App\Http\Controllers\Student\QuizController as StudentQuizController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Frontend Routes (public)
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
| Student Auth
|--------------------------------------------------------------------------
*/
Route::get('/student/login', [StudentAuthController::class, 'showLogin'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
Route::get('/student/register', [StudentAuthController::class, 'showRegister'])->name('student.register');
Route::post('/student/register', [StudentAuthController::class, 'register'])->name('student.register.submit');
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Legacy register URL → student signup
Route::get('/register', fn () => redirect()->route('student.register'));
Route::post('/register', [StudentAuthController::class, 'register']);

/*
|--------------------------------------------------------------------------
| Student Portal (logged-in students)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses');
    Route::get('/my-courses', [StudentDashboardController::class, 'enrollments'])->name('enrollments');
    Route::get('/my-courses/{enrollment}', [StudentEnrollmentController::class, 'show'])->name('enrollment.show');
    Route::post('/my-courses/{enrollment}/progress', [StudentEnrollmentController::class, 'updateProgress'])->name('enrollment.progress');
    Route::get('/my-courses/{enrollment}/quiz', [StudentQuizController::class, 'show'])->name('quiz.show');
    Route::post('/my-courses/{enrollment}/quiz', [StudentQuizController::class, 'submit'])->name('quiz.submit');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{course}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{course}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.checkout.submit');
});

// Public cart URLs redirect into student area
Route::redirect('/cart', '/student/cart');
Route::redirect('/cart/checkout', '/student/cart/checkout');

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::resource('students', StudentController::class);
    Route::resource('instructors', InstructorController::class);
    Route::resource('enrollments', EnrollmentController::class)->except(['show']);
});
