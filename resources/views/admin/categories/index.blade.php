@extends('layouts.admin')

@section('content')
<div class="bg-black text-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Categories</h2>
        <a href="{{ route('admin.categories.create') }}"
            class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">Add Category</a>
    </div>

    @if (session('success'))
        <div class="bg-green-900 border-l-4 border-green-600 text-green-300 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-700">
            <thead>
                <tr class="bg-gray-800 text-gray-300 uppercase text-sm">
                    <th class="py-3 px-4 border border-gray-700">Name</th>
                    <th class="py-3 px-4 border border-gray-700">Slug</th>
                    <th class="py-3 px-4 border border-gray-700">Icon</th>
                    <th class="py-3 px-4 border border-gray-700">Status</th>
                    <th class="py-3 px-4 border border-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b border-gray-700 hover:bg-gray-900">
                        <td class="py-3 px-4 border border-gray-700">{{ $category->name }}</td>
                        <td class="py-3 px-4 border border-gray-700">{{ $category->slug }}</td>
                        <td class="py-3 px-4 border border-gray-700">
                            @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}"
                                    class="h-10 w-10 object-cover border border-gray-600 rounded bg-gray-800 p-1">
                            @else
                                <span class="text-gray-500">No Icon</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 border border-gray-700">
                            <span class="{{ $category->is_active ? 'text-green-500' : 'text-red-500' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4 border border-gray-700">
                            <a href="{{ route('admin.categories.edit', $category) }}"
                                class="text-gray-300 hover:text-white hover:underline">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-400 hover:underline ml-2"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-4 text-center text-gray-500">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
