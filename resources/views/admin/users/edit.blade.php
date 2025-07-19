@extends('layouts.admin')

@section('content')
<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4 text-black">Edit User</h2>
    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-black">Name</label>
                <input type="text" name="name" id="name" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white" 
                    value="{{ old('name', $user->name) }}">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-black">Email</label>
                <input type="email" name="email" id="email" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white" 
                    value="{{ old('email', $user->email) }}">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-black">Password (leave blank to keep unchanged)</label>
                <input type="password" name="password" id="password" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-black">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white">
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-black">Phone</label>
                <input type="text" name="phone" id="phone" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white" 
                    value="{{ old('phone', $user->phone) }}">
                @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-black">Address</label>
                <textarea name="address" id="address" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white">{{ old('address', $user->address) }}</textarea>
                @error('address') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-black">Role</label>
                <select name="role" id="role" 
                    class="mt-1 block w-full border border-gray-700 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 text-black bg-white">
                    <option value="customer" {{ old('role', $user->role) == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">Update</button>
            <a href="{{ route('users.index') }}" class="ml-2 text-gray-700 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
