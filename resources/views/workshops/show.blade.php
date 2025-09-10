@extends('layouts.vertical', ['title' => 'Workshop Details', 'sub_title' => 'Workshops', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Page Title Section -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-6">
            <div>
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-300 dark:hover:text-white">
                                <i class="mgc_home_3_line text-lg mr-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="mgc_right_line text-gray-400 text-sm"></i>
                                <a href="{{ route('workshops.index') }}"
                                    class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Workshops</a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i class="mgc_right_line text-gray-400 text-sm"></i>
                                <span
                                    class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $workshop->title }}</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h4 class="text-xl font-medium text-gray-800 dark:text-gray-100 mt-2">Workshop Details</h4>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Workshop Image -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        @if ($workshop->path)
                            <img src="{{ asset('storage/' . $workshop->path) }}" alt="{{ $workshop->title }}"
                                class="w-full h-auto rounded-lg">
                        @else
                            <div
                                class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                <i class="mgc_image_line text-gray-400 text-5xl"></i>
                            </div>
                        @endif
                        <h5 class="text-lg font-medium text-gray-900 dark:text-white mt-4">{{ $workshop->title }}</h5>
                    </div>
                </div>
            </div>

            <!-- Workshop Details -->
            <div class="lg:col-span-2">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Workshop Information</h4>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ID</p>
                                <p class="text-base font-medium text-gray-900 dark:text-white">{{ $workshop->id }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Date</p>
                                <p class="text-base font-medium text-gray-900 dark:text-white">{{ $workshop->Date }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">End Date</p>
                                <p class="text-base font-medium text-gray-900 dark:text-white">{{ $workshop->ended_at }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Created At</p>
                                <p class="text-base font-medium text-gray-900 dark:text-white">{{ $workshop->created_at->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Updated At</p>
                                <p class="text-base font-medium text-gray-900 dark:text-white">{{ $workshop->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-sm text-gray-500 dark:text-gray-400">Description</p>
                            <div class="mt-2 text-base text-gray-900 dark:text-white">
                                {{ $workshop->description }}
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3 mt-6">
                            <a href="{{ route('workshops.edit', $workshop) }}"
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="mgc_edit_line text-lg mr-2"></i> Edit
                            </a>
                            <a href="{{ route('workshops.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="mgc_arrow_left_line text-lg mr-2"></i> Back to List
                            </a>
                            <form action="{{ route('workshops.destroy', $workshop) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this workshop?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    <i class="mgc_delete_line text-lg mr-2"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->
@endsection

@section('script')
@endsection