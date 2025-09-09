@extends('layouts.vertical', ['title' => 'Create Course', 'sub_title' => 'Courses', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                            <li class="text-gray-700 dark:text-gray-300">Create</li>
                        </ol>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white">Create Course</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="w-full">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <form action="{{ route('courses.store') }}" method="POST">
                            @csrf

                            @if ($errors->any())
                                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="mb-6">
                                    <label for="Name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                                    <input type="text" name="Name" id="Name" value="{{ old('Name') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                                </div>

                                <div class="mb-6">
                                    <label for="By" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Instructor</label>
                                    <input type="text" name="By" id="By" value="{{ old('By') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="mb-6">
                                    <label for="difficulty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Difficulty</label>
                                    <select name="difficulty" id="difficulty" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="">Select Difficulty</option>
                                        <option value="Beginner" {{ old('difficulty') == 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                        <option value="Intermediate" {{ old('difficulty') == 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                        <option value="Advanced" {{ old('difficulty') == 'Advanced' ? 'selected' : '' }}>Advanced</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Type</label>
                                    <select name="type" id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="">Select Type</option>
                                        <option value="Video" {{ old('type') == 'Video' ? 'selected' : '' }}>Video</option>
                                        <option value="Text" {{ old('type') == 'Text' ? 'selected' : '' }}>Text</option>
                                        <option value="Mixed" {{ old('type') == 'Mixed' ? 'selected' : '' }}>Mixed</option>
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration</label>
                                    <input type="text" name="duration" id="duration" value="{{ old('duration') }}" placeholder="e.g. 2 hours" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="mb-6">
                                    <label for="num_video" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Number of Videos</label>
                                    <input type="text" name="num_video" id="num_video" value="{{ old('num_video') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="mb-6">
                                    <label for="released_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Release Date</label>
                                    <input type="date" name="released_at" id="released_at" value="{{ old('released_at') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>

                                <div class="mb-6">
                                    <label for="categories_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                    <select name="categories_id" id="categories_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-6">
                                    <label for="telegram_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Telegram Link</label>
                                    <input type="text" name="telegram_link" id="telegram_link" value="{{ old('telegram_link') }}" placeholder="https://t.me/example" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                </div>
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                <a href="{{ route('courses.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                    Cancel
                                </a>
                                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Create Course
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection