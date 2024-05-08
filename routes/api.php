<?php

use App\Http\Controllers\Mobile\BookingController;
use App\Http\Controllers\Mobile\WorkshopController;
use App\Http\Controllers\Mobile\ArticleController;
use App\Http\Controllers\Mobile\ProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mobile\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('V1/flutter')->middleware('auth:sanctum')->group(function () {
    Route::get('bookings/services', [BookingController::class, 'services']);
    Route::get('bookings/workshops', [BookingController::class, 'workshops']);
    Route::get('bookings/volunteers', [BookingController::class, 'volunteers']);
    Route::apiResource('users', UserController::class)->except('login', "signup");
    Route::apiResource('workshops', WorkshopController::class);
    Route::apiResource('bookings', BookingController::class);
    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('programs', ProgramController::class);
});

Route::prefix('V1/flutter')->controller(UserController::class)->group(function () {
    Route::post('users/login', 'login');
    Route::post('users/signup', 'signup');
    Route::post('users/auth', 'auth');
});
