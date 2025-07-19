@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold text-black">Users</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Add User</a>
    </div>
    @if (session('success'))
        <div class="bg-gray-100 border-l-4 border-gray-700 text-gray-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-gray-100 border-l-4 border-gray-700 text-gray-700 p-4 mb-4">
            {{ session('error') }}
        </div>
    @endif
    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-700">
            <thead>
                <tr class="bg-gray-300 text-gray-900 uppercase text-sm border-b border-gray-700">
                    <th class="py-3 px-4 border-r border-gray-700">Name</th>
                    <th class="py-3 px-4 border-r border-gray-700">Email</th>
                    <th class="py-3 px-4 border-r border-gray-700">Phone</th>
                    <th class="py-3 px-4 border-r border-gray-700">Role</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="border-b border-gray-700">
                        <td class="py-3 px-4 border-r border-gray-700">{{ $user->name }}</td>
                        <td class="py-3 px-4 border-r border-gray-700">{{ $user->email }}</td>
                        <td class="py-3 px-4 border-r border-gray-700">{{ $user->phone ?? 'N/A' }}</td>
                        <td class="py-3 px-4 border-r border-gray-700">{{ ucfirst($user->role) }}</td>
                        <td class="py-3 px-4">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-gray-900 hover:underline">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-900 hover:underline ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-4 text-center text-gray-600">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
