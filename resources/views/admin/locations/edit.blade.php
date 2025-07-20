@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 text-black">Edit Location</h2>
    <form action="{{ route('admin.locations.update', $location) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-900 mb-1">Name</label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black text-black" 
                    value="{{ old('name', $location->name) }}"
                    required
                >
                @error('name') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-900 mb-1">Address</label>
                <textarea 
                    name="address" 
                    id="address" 
                    rows="3" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black text-black"
                    required
                >{{ old('address', $location->address) }}</textarea>
                @error('address') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-900 mb-1">Latitude</label>
                <input 
                    type="number" 
                    step="0.00000001" 
                    name="latitude" 
                    id="latitude" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black text-black" 
                    value="{{ old('latitude', $location->latitude) }}"
                    required
                >
                @error('latitude') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-900 mb-1">Longitude</label>
                <input 
                    type="number" 
                    step="0.00000001" 
                    name="longitude" 
                    id="longitude" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black text-black" 
                    value="{{ old('longitude', $location->longitude) }}"
                    required
                >
                @error('longitude') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div class="md:col-span-2">
                <label for="operating_hours" class="block text-sm font-medium text-gray-900 mb-1">Operating Hours (JSON)</label>
                <textarea 
                    name="operating_hours" 
                    id="operating_hours" 
                    rows="5"
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black font-mono text-black"
                    required
                >{{ old('operating_hours', json_encode($location->operating_hours, JSON_PRETTY_PRINT)) }}</textarea>
                @error('operating_hours') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

            <div>
                <label for="contact_phone" class="block text-sm font-medium text-gray-900 mb-1">Contact Phone</label>
                <input 
                    type="text" 
                    name="contact_phone" 
                    id="contact_phone" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black text-black" 
                    value="{{ old('contact_phone', $location->contact_phone) }}"
                >
                @error('contact_phone') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>

           <div class="flex items-center mt-2 space-x-2">
    <!-- Hidden input agar is_active tetap terkirim sebagai 0 jika tidak dicentang -->
    <input type="hidden" name="is_active" value="0">

    <input type="checkbox" name="is_active" id="is_active" value="1"
        class="h-4 w-4 text-blue-600 bg-gray-900 border-gray-700 rounded"
        {{ old('is_active', $location->is_active) ? 'checked' : '' }}>

    <label for="is_active" class="block text-sm font-medium text-gray-300">Active</label>
    @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>


            <div>
                <label for="sort_order" class="block text-sm font-medium text-gray-900 mb-1">Sort Order</label>
                <input 
                    type="number" 
                    name="sort_order" 
                    id="sort_order" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-black focus:border-black text-black" 
                    value="{{ old('sort_order', $location->sort_order ?? 0) }}"
                >
                @error('sort_order') 
                    <p class="text-red-700 text-sm mt-1">{{ $message }}</p> 
                @enderror
            </div>
        </div>

        <div class="mt-6 flex items-center space-x-4">
            <button 
                type="submit" 
                class="bg-black text-white px-5 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black"
            >
                Update
            </button>
            <a 
                href="{{ route('admin.locations.index') }}" 
                class="text-gray-900 hover:underline focus:outline-none focus:ring-2 focus:ring-gray-700 rounded"
            >
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
