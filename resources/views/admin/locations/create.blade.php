@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Add Location</h2>
    <form action="{{ route('admin.locations.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white" value="{{ old('name') }}">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="address" class="block text-sm font-medium">Address</label>
                <textarea name="address" id="address" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white">{{ old('address') }}</textarea>
                @error('address') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="latitude" class="block text-sm font-medium">Latitude</label>
                <input type="number" step="0.00000001" name="latitude" id="latitude" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white" value="{{ old('latitude') }}">
                @error('latitude') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="longitude" class="block text-sm font-medium">Longitude</label>
                <input type="number" step="0.00000001" name="longitude" id="longitude" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white" value="{{ old('longitude') }}">
                @error('longitude') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="operating_hours" class="block text-sm font-medium">Operating Hours (JSON)</label>
                <textarea name="operating_hours" id="operating_hours" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white">{{ old('operating_hours', '{"mon-fri":"08:00-17:00","sat":"09:00-14:00","sun":"closed"}') }}</textarea>
                @error('operating_hours') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="contact_phone" class="block text-sm font-medium">Contact Phone</label>
                <input type="text" name="contact_phone" id="contact_phone" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white" value="{{ old('contact_phone') }}">
                @error('contact_phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" class="h-4 w-4 text-white bg-black border-white focus:ring-white" {{ old('is_active') ? 'checked' : '' }}>
                <label for="is_active" class="ml-2 block text-sm font-medium">Active</label>
                @error('is_active') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="sort_order" class="block text-sm font-medium">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" class="mt-1 block w-full border border-white bg-black text-white rounded-md shadow-sm focus:ring-white focus:border-white" value="{{ old('sort_order', 0) }}">
                @error('sort_order') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-300">Save</button>
            <a href="{{ route('admin.locations.index') }}" class="ml-2 text-gray-300 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
