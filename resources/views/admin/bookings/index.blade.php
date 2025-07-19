@extends('layouts.admin')

@section('content')
<div class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-200 min-h-screen p-4 md:p-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h2 class="text-3xl font-bold flex items-center gap-3">
                <svg class="w-8 h-8 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Bookings
            </h2>
            <a href="{{ route('admin.bookings.create') }}" 
               class="bg-gray-800 text-white px-5 py-2.5 rounded-lg hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Booking
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200 border-l-4 border-gray-500 p-4 mb-6 rounded-r-lg">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Table Section -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-900 text-gray-600 dark:text-gray-300 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 text-left font-medium">User</th>
                            <th class="px-6 py-4 text-left font-medium">Motorcycle</th>
                            <th class="px-6 py-4 text-left font-medium">Promocode</th>
                            <th class="px-6 py-4 text-left font-medium">Location</th>
                            <th class="px-6 py-4 text-left font-medium">Duration</th>
                            <th class="px-6 py-4 text-left font-medium">Total Cost</th>
                            <th class="px-6 py-4 text-left font-medium">Status</th>
                            <th class="px-6 py-4 text-left font-medium">Payment</th>
                            <th class="px-6 py-4 text-left font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-4 flex items-center gap-3">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ $booking->user->name }}
                                </td>
                                <td class="px-6 py-4">{{ $booking->motorcycle->name }}</td>
                                <td class="px-6 py-4">
                                    @if ($booking->promocode)
                                        <span class="text-xs bg-gray-200 dark:bg-gray-600 px-3 py-1 rounded-full">
                                            {{ $booking->promocode->code }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 italic">None</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">{{ $booking->location->name }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ $booking->start_date->format('d M Y') }} - {{ $booking->end_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 font-semibold">Rp {{ number_format($booking->total_cost, 0) }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColor = match($booking->status) {
                                            'confirmed' => 'gray',
                                            'cancelled' => 'red',
                                            default => 'yellow'
                                        };
                                    @endphp
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-700 dark:bg-{{ $statusColor }}-800 dark:text-{{ $statusColor }}-100">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $payColor = match($booking->payment_status) {
                                            'paid' => 'gray',
                                            'failed' => 'red',
                                            default => 'yellow'
                                        };
                                    @endphp
                                    <span class="text-xs font-medium px-3 py-1 rounded-full bg-{{ $payColor }}-100 text-{{ $payColor }}-700 dark:bg-{{ $payColor }}-800 dark:text-{{ $payColor }}-100">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-3 items-center">
                                    <a href="{{ route('admin.bookings.edit', $booking) }}" 
                                       class="text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-gray-100 flex items-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 flex items-center gap-2">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center px-6 py-8 text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        No bookings found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection