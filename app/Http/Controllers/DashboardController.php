<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Booking;
use App\Models\Category;
use App\Models\Chat;
use App\Models\Course;
use App\Models\Maintenance;
use App\Models\Message;
use App\Models\Product;
use App\Models\Program;
use App\Models\Role;
use App\Models\Workshop;

class DashboardController extends Controller
{
    /**
     * Get statistics for dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function getStatistics()
    {
        $statistics = [
            'users' => User::count(),
            'articles' => Article::count(),
            'bookings' => Booking::count(),
            'categories' => Category::count(),
            'chats' => Chat::count(),
            'courses' => Course::count(),
            'maintenance' => Maintenance::count(),
            'messages' => Message::count(),
            'products' => Product::count(),
            'programs' => Program::count(),
            'roles' => Role::count(),
            'workshops' => Workshop::count(),
        ];

        return $statistics;
    }
}