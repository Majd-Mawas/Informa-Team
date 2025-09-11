@extends('layouts.vertical', ['title' => 'Dashboard', 'sub_title' => 'Menu', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
    <!-- Add any additional CSS here -->
@endsection

@section('content')
    <!-- Hidden element to store statistics data for charts -->
    <div id="dashboard-statistics" data-statistics="{{ json_encode($statistics) }}" class="hidden"></div>
    <div class="grid 2xl:grid-cols-4 gap-6 mb-6">
        <div class="2xl:col-span-3">
            <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
                <!-- Statistics Cards -->
                <div class="card bg-primary text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Users</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Registered Users</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_user_3_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['users'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-success text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Products</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Products</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_box_3_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['products'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-info text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Courses</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Courses</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_book_2_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['courses'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-warning text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Articles</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Articles</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_article_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['articles'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Additional Statistics Row -->
            </div>

            <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
                <div class="card bg-danger text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Programs</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Programs</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_slideshow_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['programs'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-purple-500 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Workshops</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Workshops</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_group_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['workshops'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-indigo-500 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Categories</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Categories</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_category_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['categories'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-pink-500 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Messages</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Messages</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_chat_1_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['messages'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Third Row of Statistics -->
            </div>

            <div class="grid xl:grid-cols-4 md:grid-cols-2 gap-6 mb-6">
                <div class="card bg-cyan-500 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Bookings</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Bookings</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_calendar_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['bookings'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-amber-500 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Chats</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Chats</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_chat_3_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['chats'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-teal-500 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Maintenance</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Maintenance</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_tools_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['maintenance'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <div class="card bg-gray-700 text-white">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-base mb-1 text-white">Roles</h4>
                                <p class="font-normal text-sm text-white/70 truncate">Total Roles</p>
                            </div>
                            <div class="text-3xl">
                                <i class="mgc_shield_user_line"></i>
                            </div>
                        </div>
                        <div class="flex items-center mt-4">
                            <h2 class="text-3xl font-bold">{{ $statistics['roles'] ?? 0 }}</h2>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
            </div>

            <div class="grid xl:grid-cols-2 gap-6 mb-6">
                <!-- Bar Chart - Model Counts -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Model Counts Comparison</h4>
                    </div>
                    <div class="p-6">
                        <div id="model_counts_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>

                <!-- Pie Chart - Data Distribution -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Distribution</h4>
                    </div>
                    <div class="p-6">
                        <div id="data_distribution_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    @vite(['resources/js/pages/dashboard.js', 'resources/js/pages/dashboard-charts.js'])
@endsection
