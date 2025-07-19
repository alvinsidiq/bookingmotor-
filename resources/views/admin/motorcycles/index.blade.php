@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-black">Motorcycles</h2>
        <a href="{{ route('admin.motorcycles.create') }}" class="inline-block bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Add Motorcycle</a>
    </div>

    @if (session('success'))
        <div class="bg-gray-100 border-l-4 border-gray-700 text-gray-800 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full table-auto text-left border border-gray-700">
            <thead>
                <tr class="bg-gray-300 text-sm uppercase text-black border-b border-gray-700">
                    <th class="px-4 py-3 border-r border-gray-700">Name</th>
                    <th class="px-4 py-3 border-r border-gray-700">Category</th>
                    <th class="px-4 py-3 border-r border-gray-700">Brand</th>
                    <th class="px-4 py-3 border-r border-gray-700">Image</th>
                    <th class="px-4 py-3 border-r border-gray-700">Rate</th>
                    <th class="px-4 py-3 border-r border-gray-700">Status</th>
                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($motorcycles as $motorcycle)
                    <tr class="border-b border-gray-700">
                        <td class="px-4 py-2 border-r border-gray-700 text-black">{{ $motorcycle->name }}</td>
                        <td class="px-4 py-2 border-r border-gray-700 text-black">{{ $motorcycle->category->name }}</td>
                        <td class="px-4 py-2 border-r border-gray-700 text-black">{{ $motorcycle->brand->name }}</td>
                        <td class="px-4 py-2 border-r border-gray-700">
                            @if ($motorcycle->image)
                                <img src="{{ asset('storage/' . $motorcycle->image) }}" class="h-10 w-10 object-cover rounded grayscale">
                            @else
                                <span class="italic text-gray-500">No Image</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border-r border-gray-700 text-black">Rp {{ number_format($motorcycle->rental_rate, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-r border-gray-700">
                            <span class="{{ $motorcycle->is_available ? 'text-gray-800' : 'text-gray-600' }}">
                                {{ $motorcycle->is_available ? 'Available' : 'Unavailable' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 whitespace-nowrap text-black">
                            <a href="{{ route('admin.motorcycles.edit', $motorcycle) }}" class="hover:underline text-gray-800">Edit</a>
                            <form action="{{ route('admin.motorcycles.destroy', $motorcycle) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-2 hover:underline text-gray-800" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-2 text-center text-gray-500 italic">No motorcycles found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
