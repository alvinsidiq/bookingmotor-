@extends('layouts.admin')

@section('content')
<div class="bg-gray-900 text-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Add User</h2>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-200">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('name') }}">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-200">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('email') }}">
                @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-200">Phone</label>
                <input type="text" name="phone" id="phone" class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" value="{{ old('phone') }}">
                @error('phone') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-200">Address</label>
                <textarea name="address" id="address" class="mt-1 block w-full bg-gray-800 border-gray-600 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                @error('address') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-200">Role</label>
                <select name="role" id="role" class="form-select mt-1 w-full bg-gray-800 border-gray-600 text-white rounded" required>
                    <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role', $user->role ?? '') === 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
            <a href="{{ route('admin.users.index') }}" class="ml-2 text-gray-300 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
