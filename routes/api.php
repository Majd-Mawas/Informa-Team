<?php

use App\Http\Controllers\Mobile\BookingController;
use App\Http\Controllers\Mobile\WorkshopController;
use App\Http\Controllers\Mobile\ArticleController;
use App\Http\Controllers\Mobile\ProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\UserController;
use App\Http\Controllers\Web\UserController as WebUserController;
use App\Http\Controllers\Web\CourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Application Section

Route::prefix('V1/flutter')->middleware('auth:sanctum')->group(function () {
    Route::get('bookings/services', [BookingController::class, 'services']);
    Route::get('bookings/workshops', [BookingController::class, 'workshops']);
    Route::get('bookings/volunteers', [BookingController::class, 'volunteers']);
    Route::apiResource('users', UserController::class)->except('login', "signup")->names([
        'index' => 'v1.flutter.users.index',
        'show' => 'v1.flutter.users.show',
        'store' => 'v1.flutter.users.store',
        'update' => 'v1.flutter.users.update',
        'destroy' => 'v1.flutter.users.destroy',
    ]);

    Route::apiResource('workshops', WorkshopController::class)->names([
        'index' => 'v1.flutter.workshops.index',
        'show' => 'v1.flutter.workshops.show',
        'store' => 'v1.flutter.workshops.store',
        'update' => 'v1.flutter.workshops.update',
        'destroy' => 'v1.flutter.workshops.destroy',
    ]);

    Route::apiResource('bookings', BookingController::class)->names([
        'index' => 'v1.flutter.bookings.index',
        'show' => 'v1.flutter.bookings.show',
        'store' => 'v1.flutter.bookings.store',
        'update' => 'v1.flutter.bookings.update',
        'destroy' => 'v1.flutter.bookings.destroy',
    ]);

    Route::apiResource('articles', ArticleController::class)->names([
        'index' => 'v1.flutter.articles.index',
        'show' => 'v1.flutter.articles.show',
        'store' => 'v1.flutter.articles.store',
        'update' => 'v1.flutter.articles.update',
        'destroy' => 'v1.flutter.articles.destroy',
    ]);

    Route::apiResource('programs', ProgramController::class)->names([
        'index' => 'v1.flutter.programs.index',
        'show' => 'v1.flutter.programs.show',
        'store' => 'v1.flutter.programs.store',
        'update' => 'v1.flutter.programs.update',
        'destroy' => 'v1.flutter.programs.destroy',
    ]);

    Route::apiResource('courses', CourseController::class)->names([
        'index' => 'v1.flutter.courses.index',
        'show' => 'v1.flutter.courses.show',
        'store' => 'v1.flutter.courses.store',
        'update' => 'v1.flutter.courses.update',
        'destroy' => 'v1.flutter.courses.destroy',
    ]);
});

Route::prefix('V1/flutter')->controller(UserController::class)->group(function () {
    Route::post('users/login', 'login');
    Route::post('users/signup', 'signup');
    Route::post('users/auth', 'auth');
});



// Web Section

Route::prefix('V1/web')->middleware('auth:sanctum')->group(function () {
    Route::get('bookings/services', [BookingController::class, 'services']);
    Route::get('bookings/workshops', [BookingController::class, 'workshops']);
    Route::get('bookings/volunteers', [BookingController::class, 'volunteers']);
    Route::apiResource('users', WebUserController::class)->except('login', "signup")->names([
        'index' => 'v1.web.users.index',
        'show' => 'v1.web.users.show',
        'store' => 'v1.web.users.store',
        'update' => 'v1.web.users.update',
        'destroy' => 'v1.web.users.destroy',
    ]);

    Route::apiResource('workshops', WorkshopController::class)->names([
        'index' => 'v1.web.workshops.index',
        'show' => 'v1.web.workshops.show',
        'store' => 'v1.web.workshops.store',
        'update' => 'v1.web.workshops.update',
        'destroy' => 'v1.web.workshops.destroy',
    ]);

    Route::apiResource('bookings', BookingController::class)->names([
        'index' => 'v1.web.bookings.index',
        'show' => 'v1.web.bookings.show',
        'store' => 'v1.web.bookings.store',
        'update' => 'v1.web.bookings.update',
        'destroy' => 'v1.web.bookings.destroy',
    ]);

    Route::apiResource('articles', ArticleController::class)->names([
        'index' => 'v1.web.articles.index',
        'show' => 'v1.web.articles.show',
        'store' => 'v1.web.articles.store',
        'update' => 'v1.web.articles.update',
        'destroy' => 'v1.web.articles.destroy',
    ]);

    Route::apiResource('programs', ProgramController::class)->names([
        'index' => 'v1.web.programs.index',
        'show' => 'v1.web.programs.show',
        'store' => 'v1.web.programs.store',
        'update' => 'v1.web.programs.update',
        'destroy' => 'v1.web.programs.destroy',
    ]);
    Route::apiResource('courses', CourseController::class)->names([
        'index' => 'v1.web.courses.index',
        'show' => 'v1.web.courses.show',
        'store' => 'v1.web.courses.store',
        'update' => 'v1.web.courses.update',
        'destroy' => 'v1.web.courses.destroy',
    ]);
});

Route::prefix('V1/web')->controller(WebUserController::class)->group(function () {
    Route::post('users/login', 'login');
    Route::post('users/signup', 'signup');
    Route::post('users/auth', 'auth');
});
