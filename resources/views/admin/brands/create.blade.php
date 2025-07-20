@extends('layouts.admin')

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 md:p-8">
        <!-- Header Section -->
        <h2 class="text-3xl font-bold mb-8 flex items-center gap-3">
            <svg class="w-8 h-8 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h10m0 0v10m0-10l-7 7m7-7H7" />
            </svg>
            Add Brand
        </h2>

        <!-- Error Message -->
        @if (session('error'))
            <div class="bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Name
                    </label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name') }}"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-gray-500 focus:border-gray-500 transition">
                    @error('name')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Description
                    </label>
                    <textarea name="description" id="description"
                              class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-gray-500 focus:border-gray-500 transition">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Logo -->
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Logo
                    </label>
                    <input type="file" name="logo" id="logo"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-gray-500 focus:border-gray-500 transition">
                    @error('logo')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active -->
                <!-- Active -->
<div>
    <label for="is_active" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        Active
    </label>

    <!-- hidden field to send false when unchecked -->
    <input type="hidden" name="is_active" value="0">

    <!-- checkbox for true -->
    <input type="checkbox" name="is_active" id="is_active" value="1"
           class="h-5 w-5 text-gray-600 dark:text-gray-300 border-gray-300 dark:border-gray-600 rounded focus:ring-gray-500 transition"
           {{ old('is_active', true) ? 'checked' : '' }}>

    @error('is_active')
        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
    @enderror
</div>


                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h18M3 8h18M3 12h18M3 16h18M3 20h18" />
                        </svg>
                        Sort Order
                    </label>
                    <input type="number" name="sort_order" id="sort_order"
                           value="{{ old('sort_order', 0) }}"
                           class="w-full rounded-lg border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:ring-gray-500 focus:border-gray-500 transition">
                    @error('sort_order')
                        <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end items-center gap-4 pt-6">
                <a href="{{ route('admin.brands.index') }}"
                   class="px-4 py-2 text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Cancel
                </a>
                <button type="submit"
                        class="bg-gray-800 text-white px-5 py-2.5 rounded-lg hover:bg-gray-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Save Brand
                </button>
            </div>
        </form>
    </div>
</div>
@endsection