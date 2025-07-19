@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Edit Category</h2>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:ring-white focus:border-white"
                    value="{{ old('name', $category->name) }}">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:ring-white focus:border-white">{{ old('description', $category->description) }}</textarea>
                @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Icon --}}
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-300">Icon</label>
                <input type="file" name="icon" id="icon"
                    class="mt-1 block w-full text-white bg-gray-800 border border-gray-600 rounded-md shadow-sm">
                @if ($category->icon)
                    <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                        class="mt-2 h-16 w-16 object-contain border border-white rounded bg-gray-900 p-1">
                @endif
                @error('icon') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-300">Image</label>
                <input type="file" name="image" id="image"
                    class="mt-1 block w-full text-white bg-gray-800 border border-gray-600 rounded-md shadow-sm">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                        class="mt-2 h-16 w-16 object-contain border border-white rounded bg-gray-900 p-1">
                @endif
                @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            {{-- Active --}}
            <div class="flex items-center mt-2 space-x-2 md:col-span-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                    class="h-4 w-4 text-white bg-gray-800 border border-gray-600 rounded"
                    {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="text-sm font-medium text-gray-300">Active</label>
                @error('is_active') <span class="text-red-400 text-sm ml-4">{{ $message }}</span> @enderror
            </div>

            {{-- Sort Order --}}
            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-300">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order"
                    class="mt-1 block w-full bg-gray-800 text-white border border-gray-600 rounded-md shadow-sm focus:ring-white focus:border-white"
                    value="{{ old('sort_order', $category->sort_order) }}">
                @error('sort_order') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-300">Update</button>
            <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-400 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
