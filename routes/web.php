<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('/home', fn() => view('index'))->name('home');
    
    // Products CRUD routes
    Route::resource('products', ProductController::class);
    
    // Categories CRUD routes
    Route::resource('categories', CategoryController::class);
    
    // Courses CRUD routes
    Route::resource('courses', CourseController::class);
    
    // Programs CRUD routes
    Route::resource('programs', ProgramController::class);
    
    // Workshops CRUD routes
    Route::resource('workshops', WorkshopController::class);
    
    // Articles CRUD routes
    Route::resource('articles', ArticleController::class);
    
    // Support Dashboard routes
    Route::prefix('support')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\Web\SupportDashboardController::class, 'index'])->name('support.dashboard');
        Route::get('/chat/{chat}', [\App\Http\Controllers\Web\SupportDashboardController::class, 'showChat'])->name('support.chat');
        Route::post('/chat/{chat}/send', [\App\Http\Controllers\Web\SupportDashboardController::class, 'sendSupportMessage'])->name('support.send-message');
        Route::post('/chat/{chat}/resolve', [\App\Http\Controllers\Web\SupportDashboardController::class, 'resolveChat'])->name('support.resolve');
        Route::get('/resolved', [\App\Http\Controllers\Web\SupportDashboardController::class, 'resolvedChats'])->name('support.resolved');
    });
    
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
