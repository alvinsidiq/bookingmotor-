<div class="py-10 bg-gray-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-2xl p-8 max-w-5xl mx-auto">
        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        {{-- Detail Motor --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Gambar Motor --}}
            <div>
                @if ($motorcycle->image)
                    <img src="{{ asset('storage/' . $motorcycle->image) }}" alt="{{ $motorcycle->name }}"
                        class="w-full h-72 object-cover rounded-xl shadow-md">
                @else
                    <div class="w-full h-72 bg-gray-200 rounded-xl flex items-center justify-center text-gray-500 text-lg font-semibold">
                        No Image Available
                    </div>
                @endif
            </div>

            {{-- Info Motor --}}
            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $motorcycle->name }}</h2>
                <div class="space-y-2 text-gray-600 text-sm">
                    <p><span class="font-semibold text-gray-700">Category:</span> {{ $motorcycle->category->name }}</p>
                    <p><span class="font-semibold text-gray-700">Brand:</span> {{ $motorcycle->brand->name }}</p>
                    <p><span class="font-semibold text-gray-700">Rental Rate:</span> 
                        <span class="text-blue-600 font-medium">Rp {{ number_format($motorcycle->rental_rate, 0) }}/day</span>
                    </p>
                    <p><span class="font-semibold text-gray-700">Description:</span> 
                        {{ $motorcycle->description ?? 'No description available.' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Booking Section --}}
        @auth
            <div class="mt-10 border-t pt-6">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Book This Motorcycle</h3>

                <div class="space-y-6">
                    <!-- Location -->
                    <div>
                        <label for="location_id" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                        <select wire:model.live="location_id" id="location_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            <option value="">Select Location</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}">{{ $location->name }}</option>
                            @endforeach
                        </select>
                        @error('location_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Promocode -->
                    <div>
                        <label for="promocode_id" class="block text-sm font-medium text-gray-700 mb-1">Promocode (Optional)</label>
                        <select wire:model.live="promocode_id" id="promocode_id"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                            <option value="">None</option>
                            @foreach ($promocodes as $promocode)
                                <option value="{{ $promocode->id }}">{{ $promocode->code }}</option>
                            @endforeach
                        </select>
                        @error('promocode_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="datetime-local" wire:model.live="start_date" id="start_date"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- End Date -->
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="datetime-local" wire:model.live="end_date" id="end_date"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                        @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Total Cost & Button -->
                    <div>
                        <p class="text-gray-800 text-base font-medium mb-2">
                            Total Cost:
                            <span class="text-green-600 font-semibold">
                                Rp {{ number_format($total_cost, 0) }}
                            </span>
                        </p>

                        <button wire:click="book" wire:loading.attr="disabled"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow-md transition duration-150">
                            Book Now
                        </button>

                        <div wire:loading wire:target="book" class="mt-2 text-sm text-gray-600">Processing...</div>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-8 text-center text-gray-600">
                <p>Please <a href="{{ route('login') }}" class="text-green-600 hover:underline font-medium">login</a> or
                    <a href="{{ route('register') }}" class="text-green-600 hover:underline font-medium">register</a> to book this motorcycle.</p>
            </div>
        @endauth
    </div>
</div>
