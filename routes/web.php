<?php

use Illuminate\Support\Facades\Route;
use App\Models\{Article, Booking, Category, Course, Maintenance, Message, Program, Rating, Role, Service, Shift, Time, Training, User, Workshop};

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/Article', function () {
//     return Article::with("author", "rating")->get();
// });

// Route::get('/Booking', function () {
//     // return Booking::where('role_id', 3)->with("services")->get();
//     return Booking::with("user", "workshop", "services", "time")->get();
// });

// Route::get('/Category', function () {
//     return Category::with("courses", "programs")->get();
// });

// Route::get('/Courses', function () {
//     return Course::with("services", "category")->get();
// });

// Route::get('/Maintenances', function () {
//     return Maintenance::with("services")->get();
// });

// Route::get('/Message', function () {
//     return Message::with("user")->get();
// });

// Route::get('/Programs', function () {
//     return Program::with("services", "category")->get();
// });
// Route::get('/Rating', function () {
//     return Rating::with("article", "user")->get();
// });
// Route::get('/Role', function () {
//     return Role::with("users")->get();
// });

// Route::get('/Services', function () {
//     return Service::with("beneficiaries", "programs", "courses", "maintenances", "volunteers", "booking")->get();
// });

// Route::get('/Shifts', function () {
//     return Shift::with("volunteers", "coach", "time")->get();
// });

// Route::get('/Time', function () {
//     return Time::with("shift", "booking")->get();
// });

// Route::get('/Trainings', function () {
//     return Training::with("trainees")->get();
// });

// Route::get('/Users', function () {
//     return user::with("training", "shifts", "workshops", "vol_services", "services", "article", "message", "rating", "role")->get();
// });

// Route::get('/Workshops', function () {
//     return Workshop::with("coach", "booking")->get();
// });
