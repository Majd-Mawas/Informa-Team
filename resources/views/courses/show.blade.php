@extends('layouts.vertical', ['title' => 'Course Details', 'sub_title' => 'Courses', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container mx-auto px-4 py-6">

        <!-- start page title -->
        <div class="max-w-7xl mx-auto">
            <div class="w-full">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex-1">
                        <ol class="flex text-sm">
                            <li class="flex items-center">
                                <a href="{{ route('any', 'index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Dashboard</a>
                                <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </li>
                            <li class="flex items-center">
                                <a href="{{ route('courses.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Courses</a>
                                <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </li>
                            <li class="text-gray-700 dark:text-gray-300">{{ $course->Name }}</li>
                        </ol>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white">Course Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="w-full">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->id }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Name</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->Name }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Instructor</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->By ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Difficulty</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->difficulty ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Type</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->type ?? 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Duration</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->duration ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Number of Videos</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->num_video ?? 'N/A' }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Release Date</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->released_at ? date('F j, Y', strtotime($course->released_at)) : 'N/A' }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ $course->category ? $course->category->name : 'N/A' }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h5>
                                    <p class="text-base text-gray-900 dark:text-white">{{ date('F j, Y, g:i a', strtotime($course->created_at)) }}</p>
                                </div>
                                <div>
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Telegram Link</h5>
                                    @if($course->telegram_link)
                                        <p class="text-base text-blue-600 dark:text-blue-400">
                                            <a href="{{ $course->telegram_link }}" target="_blank" class="hover:underline">{{ $course->telegram_link }}</a>
                                        </p>
                                    @else
                                        <p class="text-base text-gray-900 dark:text-white">N/A</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end space-x-3 mt-8">
                            <a href="{{ route('courses.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                Back to List
                            </a>
                            <a href="{{ route('courses.edit', $course->id) }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Edit
                            </a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection