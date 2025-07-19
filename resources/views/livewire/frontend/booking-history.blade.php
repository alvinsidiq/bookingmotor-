<div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">My Bookings</h2>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 mb-6 rounded-md">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-600 text-red-800 p-4 mb-6 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-green-100 text-green-800 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-6 py-3">Motorcycle</th>
                            <th class="px-6 py-3">Promocode</th>
                            <th class="px-6 py-3">Location</th>
                            <th class="px-6 py-3">Duration</th>
                            <th class="px-6 py-3">Total Cost</th>
                            <th class="px-6 py-3">Status</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium">{{ $booking->motorcycle->name }}</td>
                                <td class="px-6 py-4">{{ $booking->promocode ? $booking->promocode->code : 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $booking->location->name }}</td>
                                <td class="px-6 py-4">
                                    <span class="block text-sm">{{ $booking->start_date->format('Y-m-d H:i') }}</span>
                                    <span class="block text-sm text-gray-500">to {{ $booking->end_date->format('Y-m-d H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 font-semibold text-green-600">Rp {{ number_format($booking->total_cost, 0) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        {{ $booking->status == 'confirmed' ? 'bg-green-200 text-green-800' :
                                            ($booking->status == 'cancelled' ? 'bg-red-200 text-red-800' :
                                            'bg-yellow-200 text-yellow-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($booking->status !== 'cancelled' && $booking->payment_status !== 'paid')
                                        <button
                                            wire:click="cancelBooking({{ $booking->id }})"
                                            wire:loading.attr="disabled"
                                            onclick="return confirm('Are you sure you want to cancel this booking?')"
                                            class="text-red-600 hover:underline text-sm font-semibold disabled:text-gray-400">
                                            Cancel
                                        </button>
                                        <div wire:loading wire:target="cancelBooking({{ $booking->id }})" class="text-gray-500 text-xs mt-1">Cancelling...</div>
                                    @else
                                        <span class="text-gray-400 text-sm italic">No action</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No bookings found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
