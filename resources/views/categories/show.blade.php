@extends('layouts.vertical', ['title' => 'Category Details', 'sub_title' => 'Categories', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                                <a href="{{ route('categories.index') }}" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Categories</a>
                                <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </li>
                            <li class="text-gray-700 dark:text-gray-300">Category Details</li>
                        </ol>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white">Category Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="w-full">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ $category->name }}</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-24">ID:</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-300">{{ $category->id }}</span>
                                        </div>
                                    </div>
                                    <div class="space-y-3">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-24">Created:</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-300">{{ $category->created_at->format('F d, Y h:i A') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-24">Updated:</span>
                                            <span class="text-sm text-gray-900 dark:text-gray-300">{{ $category->updated_at->format('F d, Y h:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-6">
                                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Description:</h4>
                                    <p class="text-sm text-gray-900 dark:text-gray-300">{{ $category->description ?? 'No description available' }}</p>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 mt-6">
                                    <a href="{{ route('categories.edit', $category) }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="mgc_edit_line me-1"></i> Edit
                                    </a>
                                    <a href="{{ route('categories.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                        <i class="mgc_arrow_left_line me-1"></i> Back to List
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            <i class="mgc_delete_line me-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection