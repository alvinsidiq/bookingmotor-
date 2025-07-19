@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Brands</h2>
        <a href="{{ route('admin.brands.create') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-300">Add Brand</a>
    </div>

    @if (session('success'))
        <div class="bg-gray-800 border-l-4 border-gray-600 text-white p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-900 text-gray-300 uppercase text-sm">
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Slug</th>
                    <th class="py-3 px-4">Logo</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($brands as $brand)
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4 text-lg">{{ $brand->name }}</td>
                        <td class="py-3 px-4 text-lg">{{ $brand->slug }}</td>
                        <td class="py-3 px-4">
                            @if ($brand->logo)
                                <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}" class="h-16 w-auto bg-gray-800 border border-white rounded p-2 object-contain">
                            @else
                                No Logo
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="{{ $brand->is_active ? 'text-white' : 'text-gray-500' }}">
                                {{ $brand->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.brands.edit', $brand) }}" class="text-gray-300 hover:underline">Edit</a>
                            <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-500 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-4 text-center text-gray-400">No brands found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
