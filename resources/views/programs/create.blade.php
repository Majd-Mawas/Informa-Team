@extends('layouts.vertical', ['title' => 'Create Program', 'sub_title' => 'Management', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">


        <div class="grid grid-cols-1 gap-6">
            <div class="w-full">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white">Add New Program</h4>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <div class="space-y-2">
                                <label for="Name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Name <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('Name') border-red-500 @enderror" id="Name" name="Name" value="{{ old('Name') }}" required>
                                @error('Name')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="Released_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Released At <span class="text-red-500">*</span></label>
                                <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('Released_at') border-red-500 @enderror" id="Released_at" name="Released_at" value="{{ old('Released_at') }}" required>
                                @error('Released_at')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="categories_id" class="form-label">Category</label>
                                <select class="form-select @error('categories_id') is-invalid @enderror" id="categories_id" name="categories_id">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('categories_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categories_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="path" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program File</label>
                                <input type="file" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('path') border-red-500 @enderror" id="path" name="path">
                                @error('path')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="size" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Size</label>
                                <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('size') border-red-500 @enderror" id="size" name="size" value="{{ old('size') }}">
                                @error('size')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="telegram_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telegram Link</label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('telegram_link') border-red-500 @enderror" id="telegram_link" name="telegram_link" value="{{ old('telegram_link') }}">
                                @error('telegram_link')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="youtube_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">YouTube Link</label>
                                <input type="url" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('youtube_link') border-red-500 @enderror" id="youtube_link" name="youtube_link" value="{{ old('youtube_link') }}">
                                @error('youtube_link')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white @error('description') border-red-500 @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg text-sm">Create Program</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->
@endsection