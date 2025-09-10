@extends('layouts.vertical', ['title' => 'Articles', 'sub_title' => 'Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- Breadcrumb -->
        <div class="flex items-center py-4">
            <a href="{{ route('articles.index') }}" class="text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400">
                <i class="uil uil-angle-left mr-1"></i> Back to Articles
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Article Details</h4>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Article Image -->
                            <div class="flex justify-center items-center">
                                @if ($article->path)
                                    <img src="{{ asset('storage/' . $article->path) }}" alt="{{ $article->title }}" class="rounded-lg shadow-md max-h-96 object-contain">
                                @else
                                    <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                        <span class="text-gray-500 dark:text-gray-400"><i class="uil uil-image-alt text-4xl"></i></span>
                                    </div>
                                @endif
                            </div>

                            <!-- Article Details -->
                            <div class="space-y-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $article->title }}</h2>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">By {{ $article->author_name }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</p>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $article->id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Release Date</p>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $article->released_at }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Created At</p>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $article->created_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Updated At</p>
                                        <p class="text-base text-gray-900 dark:text-white">{{ $article->updated_at->format('Y-m-d H:i') }}</p>
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Content</p>
                                    <div class="mt-2 p-4 bg-gray-50 dark:bg-gray-700 rounded-md">
                                        <p class="text-gray-800 dark:text-gray-200 whitespace-pre-line">{{ $article->body }}</p>
                                    </div>
                                </div>

                                <div class="flex space-x-3 mt-6">
                                    <a href="{{ route('articles.edit', $article) }}" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <i class="uil uil-edit mr-1"></i> Edit
                                    </a>
                                    <a href="{{ route('articles.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">
                                        <i class="uil uil-list-ul mr-1"></i> Back to List
                                    </a>
                                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Are you sure you want to delete this article?')">
                                            <i class="uil uil-trash-alt mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
@endsection