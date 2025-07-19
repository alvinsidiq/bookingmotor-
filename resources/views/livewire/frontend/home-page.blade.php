<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Featured Motorcycles -->
    <section class="mb-16">
        <h2 class="text-4xl font-bold text-center text-gray-800 mb-10">🚀 Featured Motorcycles</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @forelse ($motorcycles as $motorcycle)
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden">
                    @if ($motorcycle->image)
                        <img src="{{ asset('storage/' . $motorcycle->image) }}" alt="{{ $motorcycle->name }}" class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">No Image</div>
                    @endif

                    <div class="p-5">
                        <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $motorcycle->name }}</h3>
                        <p class="text-sm text-gray-500 mb-1">Category: {{ $motorcycle->category->name }}</p>
                        <p class="text-sm text-gray-500 mb-1">Brand: {{ $motorcycle->brand->name }}</p>
                        <p class="text-lg text-green-600 font-bold mt-2">Rp {{ number_format($motorcycle->rental_rate, 0) }} <span class="text-sm font-normal">/day</span></p>

                        <a href="{{ route('frontend.motorcycles.show', $motorcycle->slug) }}"
                           class="mt-4 inline-block w-full text-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                            Book Now
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500 text-lg">No motorcycles available at the moment.</div>
            @endforelse
        </div>
    </section>
</div>
