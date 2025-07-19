@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Edit Promocode</h2>
    <form action="{{ route('admin.promocodes.update', $promocode) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-300">Category</label>
                <select name="category_id" id="category_id" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id', $promocode->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="code" class="block text-sm font-medium text-gray-300">Code</label>
                <input type="text" name="code" id="code" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white" 
                    value="{{ old('code', $promocode->code) }}">
                @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                <textarea name="description" id="description" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white">{{ old('description', $promocode->description) }}</textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="discount_type" class="block text-sm font-medium text-gray-300">Discount Type</label>
                <select name="discount_type" id="discount_type" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white">
                    <option value="percentage" {{ old('discount_type', $promocode->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                    <option value="fixed" {{ old('discount_type', $promocode->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                </select>
                @error('discount_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="discount_value" class="block text-sm font-medium text-gray-300">Discount Value</label>
                <input type="number" step="0.01" name="discount_value" id="discount_value" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white" 
                    value="{{ old('discount_value', $promocode->discount_value) }}">
                @error('discount_value') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="valid_from" class="block text-sm font-medium text-gray-300">Valid From</label>
                <input type="date" name="valid_from" id="valid_from" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white" 
                    value="{{ old('valid_from', $promocode->valid_from->format('Y-m-d')) }}">
                @error('valid_from') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="valid_until" class="block text-sm font-medium text-gray-300">Valid Until</label>
                <input type="date" name="valid_until" id="valid_until" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white" 
                    value="{{ old('valid_until', $promocode->valid_until->format('Y-m-d')) }}">
                @error('valid_until') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="max_usage" class="block text-sm font-medium text-gray-300">Max Usage</label>
                <input type="number" name="max_usage" id="max_usage" 
                    class="mt-1 block w-full bg-gray-900 border border-gray-700 rounded-md shadow-sm 
                           focus:ring-blue-500 focus:border-blue-500 text-white" 
                    value="{{ old('max_usage', $promocode->max_usage) }}">
                @error('max_usage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_active" id="is_active" 
                    class="h-4 w-4 text-blue-600 bg-gray-900 border border-gray-700 rounded"
                    {{ old('is_active', $promocode->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="block text-sm font-medium text-gray-300">Active</label>
                @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.promocodes.index') }}" class="ml-2 text-gray-400 hover:text-gray-200 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
