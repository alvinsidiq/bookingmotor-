@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6 max-w-4xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6">Add Category</h2>

    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 gap-y-4">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:ring-white focus:border-white"
                    value="{{ old('name') }}">
                @error('name')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:ring-white focus:border-white">{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Icon --}}
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-300">Icon</label>
                <input type="file" name="icon" id="icon"
                    class="mt-1 block w-full text-white bg-gray-800 border border-gray-600 rounded-md shadow-sm">
                @error('icon')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Image</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-white bg-gray-800 border border-gray-600 rounded-md shadow-sm">
                @error('image')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Active --}}
<div class="flex items-center space-x-2 md:col-span-2 mt-4">
    <input type="hidden" name="is_active" value="0"> {{-- default value if unchecked --}}
    <input type="checkbox" name="is_active" id="is_active" value="1"
        class="h-4 w-4 text-white bg-gray-800 border-gray-600 rounded focus:ring-white focus:border-white"
        {{ old('is_active', true) ? 'checked' : '' }}>
    <label for="is_active" class="text-sm font-medium text-gray-300">Active</label>
</div>
@error('is_active')
    <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span>
@enderror


            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-300">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:ring-white focus:border-white"
                    value="{{ old('sort_order', 0) }}">
                @error('sort_order')
                    <span class="text-red-400 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Buttons --}}
        <div class="mt-6 flex justify-start">
            <button type="submit" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-300">Save</button>
            <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-400 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
