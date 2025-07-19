@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Locations</h2>
        <a href="{{ route('admin.locations.create') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-300">Add Location</a>
    </div>

    @if (session('success'))
        <div class="bg-gray-800 border-l-4 border-white text-white p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-white">
            <thead>
                <tr class="bg-gray-900 text-white uppercase text-sm border-b border-white">
                    <th class="py-3 px-4 border border-white">Name</th>
                    <th class="py-3 px-4 border border-white">Address</th>
                    <th class="py-3 px-4 border border-white">Operating Hours</th>
                    <th class="py-3 px-4 border border-white">Contact Phone</th>
                    <th class="py-3 px-4 border border-white">Status</th>
                    <th class="py-3 px-4 border border-white">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($locations as $location)
                    <tr class="border-b border-white">
                        <td class="py-3 px-4 border border-white">{{ $location->name }}</td>
                        <td class="py-3 px-4 border border-white">{{ Str::limit($location->address, 50) }}</td>
                        <td class="py-3 px-4 border border-white">
                            @php
                                $operatingHours = json_decode($location->operating_hours, true);
                            @endphp

                            @if (is_array($operatingHours))
                                @foreach ($operatingHours as $day => $hours)
                                    <span>{{ ucfirst($day) }}: {{ $hours }}</span><br>
                                @endforeach
                            @else
                                Not set
                            @endif
                        </td>
                        <td class="py-3 px-4 border border-white">{{ $location->contact_phone ?? 'N/A' }}</td>
                        <td class="py-3 px-4 border border-white">
                            <span class="{{ $location->is_active ? 'text-green-400' : 'text-red-400' }}">
                                {{ $location->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 border border-white">
                            <a href="{{ route('admin.locations.edit', $location) }}" class="text-white hover:underline">Edit</a>
                            <form action="{{ route('admin.locations.destroy', $location) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-3 px-4 text-center border border-white">No locations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
