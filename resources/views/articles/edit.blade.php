@extends('layouts.vertical', ['title' => 'Articles', 'sub_title' => 'Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="grid grid-cols-1 gap-6">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Edit Article: {{ $article->title }}</h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="space-y-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('title') border-red-500 @enderror" id="title" name="title" value="{{ old('title', $article->title) }}" required>
                                @error('title')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content <span class="text-red-500">*</span></label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('body') border-red-500 @enderror" id="body" name="body" rows="8" required>{{ old('body', $article->body) }}</textarea>
                                @error('body')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="author_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author Name <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('author_name') border-red-500 @enderror" id="author_name" name="author_name" value="{{ old('author_name', $article->author_name) }}" required>
                                @error('author_name')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="released_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Release Date <span class="text-red-500">*</span></label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('released_at') border-red-500 @enderror" id="released_at" name="released_at" value="{{ old('released_at', $article->released_at) }}" required>
                                @error('released_at')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Article Image</label>
                                @if ($article->path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $article->path) }}" alt="{{ $article->title }}" class="rounded-md shadow-sm max-h-40 object-contain">
                                    </div>
                                @endif
                                <input type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200 dark:text-gray-400 @error('image') border-red-500 @enderror" id="image" name="image" accept="image/*">
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Upload a new article image to replace the existing one (JPEG, PNG, JPG, GIF). Max size: 2MB</p>
                                @error('image')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-end space-x-3 mt-6">
                                <a href="{{ route('articles.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 dark:hover:bg-gray-600">Cancel</a>
                                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Update Article</button>
                            </div>
                        </form>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
@endsection