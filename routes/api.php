<?php

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
    Route::apiResource('users', UserController::class)->except('login', "signup");
});

Route::prefix('V1/flutter')->controller(UserController::class)->group(function () {
    Route::post('users/login', 'login');
    Route::post('users/signup', 'signup');
    Route::post('users/auth', 'auth');
});
