@extends('layouts.admin')

@section('content')
<div class="bg-black p-6 shadow rounded-lg text-white">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">Promocodes</h2>
        <a href="{{ route('admin.promocodes.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New</a>
    </div>

    @if(session('success'))
        <div class="bg-green-900 text-green-400 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full table-auto border border-gray-700">
        <thead>
            <tr class="bg-gray-900 text-left text-gray-300">
                <th class="p-2 border border-gray-700">Code</th>
                <th class="p-2 border border-gray-700">Category</th>
                <th class="p-2 border border-gray-700">Type</th>
                <th class="p-2 border border-gray-700">Value</th>
                <th class="p-2 border border-gray-700">Valid</th>
                <th class="p-2 border border-gray-700">Status</th>
                <th class="p-2 border border-gray-700">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($promocodes as $promo)
                <tr class="border-b border-gray-700 hover:bg-gray-800">
                    <td class="p-2 border border-gray-700">{{ $promo->code }}</td>
                    <td class="p-2 border border-gray-700">{{ $promo->category->name ?? '-' }}</td>
                    <td class="p-2 border border-gray-700">{{ ucfirst($promo->discount_type) }}</td>
                    <td class="p-2 border border-gray-700">{{ $promo->discount_value }}</td>
                    <td class="p-2 border border-gray-700">{{ $promo->valid_from->format('Y-m-d') }} - {{ $promo->valid_until->format('Y-m-d') }}</td>
                    <td class="p-2 border border-gray-700">{{ $promo->is_active ? 'Active' : 'Inactive' }}</td>
                    <td class="p-2 border border-gray-700">
                        <a href="{{ route('admin.promocodes.edit', $promo) }}" class="text-blue-400 hover:underline">Edit</a>
                        <form action="{{ route('admin.promocodes.destroy', $promo) }}" method="POST" class="inline" onsubmit="return confirm('Delete this promocode?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center p-4 text-gray-400">No promocodes found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
