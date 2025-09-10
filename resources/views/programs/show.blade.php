@extends('layouts.vertical', ['title' => 'Programs', 'sub_title' => 'Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

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
                                <a href="{{ route('any', 'index') }}"
                                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Dashboard</a>
                                <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </li>
                            <li class="flex items-center">
                                <a href="{{ route('programs.index') }}"
                                    class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">Programs</a>
                                <svg class="h-4 w-4 mx-2 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </li>
                            <li class="text-gray-700 dark:text-gray-300">Program Details</li>
                        </ol>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white">Program Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="w-full">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="md:col-span-1 flex justify-center">
                                @if ($program->path)
                                    <a href="{{ asset('storage/' . $program->path) }}" target="_blank"
                                        class="block w-full h-full">
                                        <div
                                            class="bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md flex items-center justify-center h-80 w-full hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                            <i class="mgc_file_line text-gray-500 dark:text-gray-400"
                                                style="font-size: 64px;"></i>
                                            <span
                                                class="ml-2 text-gray-700 dark:text-gray-300">{{ basename($program->path) }}</span>
                                        </div>
                                    </a>
                                @else
                                    <div
                                        class="bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md flex items-center justify-center h-80 w-full">
                                        <i class="mgc_file_line text-gray-400" style="font-size: 64px;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="md:col-span-2">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">{{ $program->Name }}</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</h5>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $program->id }}</p>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Released At</h5>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $program->Released_at }}</p>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Size</h5>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $program->size ?: 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Category</h5>
                                        <p class="text-base text-gray-900 dark:text-white">
                                            {{ $program->category ? $program->category->name : 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</h5>
                                        <p class="text-base text-gray-900 dark:text-white">
                                            {{ $program->created_at->format('Y-m-d H:i:s') }}</p>
                                    </div>
                                    <div>
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</h5>
                                        <p class="text-base text-gray-900 dark:text-white">
                                            {{ $program->updated_at->format('Y-m-d H:i:s') }}</p>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Description</h5>
                                    <p class="text-gray-700 dark:text-gray-300">
                                        {{ $program->description ?? 'No description available' }}</p>
                                </div>

                                @if ($program->telegram_link)
                                    <div class="mb-3">
                                        <h5 class="text-uppercase">Telegram Link</h5>
                                        <p><a href="{{ $program->telegram_link }}" target="_blank"
                                                class="btn btn-sm btn-primary">Open Telegram Link</a></p>
                                    </div>
                                @endif

                                @if ($program->youtube_link)
                                    <div class="mb-3">
                                        <h5 class="text-uppercase">YouTube Link</h5>
                                        <p><a href="{{ $program->youtube_link }}" target="_blank"
                                                class="btn btn-sm btn-danger">Watch on YouTube</a></p>
                                    </div>
                                @endif

                                @if ($program->telegram_link || $program->youtube_link)
                                    <div class="mt-6">
                                        <h5 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Links</h5>
                                        <div class="flex flex-wrap gap-2">
                                            @if ($program->telegram_link)
                                                <a href="{{ $program->telegram_link }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors">
                                                    <span>Telegram</span>
                                                    <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
                                            @if ($program->youtube_link)
                                                <a href="{{ $program->youtube_link }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors">
                                                    <span>YouTube</span>
                                                    <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="flex space-x-3 mt-8">
                                    <a href="{{ route('programs.edit', $program) }}"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Edit</a>
                                    <a href="{{ route('programs.index') }}"
                                        class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Back
                                        to List</a>
                                    <form action="{{ route('programs.destroy', $program) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                                            onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
@endsection
