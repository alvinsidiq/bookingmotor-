@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 text-black">Add Motorcycle</h2>
    <form action="{{ route('admin.motorcycles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-black">Category</label>
                <select name="category_id" id="category_id" 
                    class="mt-1 block w-full rounded-md border border-gray-700 bg-white text-black shadow-sm focus:border-black focus:ring focus:ring-gray-400 focus:ring-opacity-50">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-gray-800">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand -->
            <div>
                <label for="brand_id" class="block text-sm font-medium text-black">Brand</label>
                <select name="brand_id" id="brand_id" 
                    class="mt-1 block w-full rounded-md border border-gray-700 bg-white text-black shadow-sm focus:border-black focus:ring focus:ring-gray-400 focus:ring-opacity-50">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id')
                    <p class="mt-1 text-sm text-gray-800">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-black">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                    class="mt-1 block w-full rounded-md border border-gray-700 bg-white text-black shadow-sm focus:border-black focus:ring focus:ring-gray-400 focus:ring-opacity-50" />
                @error('name')
                    <p class="mt-1 text-sm text-gray-800">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-black">Description</label>
                <textarea name="description" id="description" rows="3" 
                    class="mt-1 block w-full rounded-md border border-gray-700 bg-white text-black shadow-sm focus:border-black focus:ring focus:ring-gray-400 focus:ring-opacity-50">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-gray-800">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-black">Image</label>
                <input type="file" name="image" id="image" 
                    class="mt-1 block w-full text-black rounded-md border border-gray-700 bg-white shadow-sm focus:border-black focus:ring focus:ring-gray-400 focus:ring-opacity-50" />
                @error('image')
                    <p class="mt-1 text-sm text-gray-800">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rental Rate -->
            <div>
                <label for="rental_rate" class="block text-sm font-medium text-black">Rental Rate (Rp)</label>
                <input type="number" step="0.01" name="rental_rate" id="rental_rate" value="{{ old('rental_rate') }}" 
                    class="mt-1 block w-full rounded-md border border-gray-700 bg-white text-black shadow-sm focus:border-black focus:ring focus:ring-gray-400 focus:ring-opacity-50" />
                @error('rental_rate')
                    <p class="mt-1 text-sm text-gray-800">{{ $message }}</p>
                @enderror
            </div>

            <!-- Available -->
            <div class="col-span-2 flex items-center space-x-3 mt-2">
                <input type="hidden" name="is_available" value="0">
                <input type="checkbox" name="is_available" id="is_available" value="1" 
                    {{ old('is_available') ? 'checked' : '' }} 
                    class="h-5 w-5 rounded border-gray-700 text-black focus:ring-gray-600" />
                <label for="is_available" class="text-sm font-medium text-black">Available</label>
            </div>
            @error('is_available')
                <p class="col-span-2 mt-1 text-sm text-gray-800">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex items-center">
            <button type="submit" 
                class="inline-flex justify-center py-2 px-4 border border-black shadow-sm text-sm font-medium rounded-md text-black bg-white hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600">
                Save
            </button>
            <a href="{{ route('admin.motorcycles.index') }}" class="ml-4 text-gray-800 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
