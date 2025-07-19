<div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Find Your Motorcycle</h2>

            {{-- Success Message --}}
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Motorcycle Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @forelse ($motorcycles as $motorcycle)
                    <div class="bg-white border rounded-xl shadow hover:shadow-lg transition duration-200">
                        @if ($motorcycle->image)
                            <img src="{{ asset('storage/' . $motorcycle->image) }}"
                                alt="{{ $motorcycle->name }}"
                                class="w-full h-48 object-cover rounded-t-xl">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-t-xl flex items-center justify-center text-gray-500">
                                No Image
                            </div>
                        @endif

                        <div class="p-4 space-y-2">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $motorcycle->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $motorcycle->category->name }} • {{ $motorcycle->brand->name }}</p>
                            <p class="text-green-600 font-bold">Rp {{ number_format($motorcycle->rental_rate, 0) }}/day</p>
                            <p class="text-gray-600 text-sm">{{ Str::limit($motorcycle->description, 80) }}</p>
                            <a href="{{ route('frontend.motorcycles.show', $motorcycle->slug) }}"
                                class="inline-block mt-4 w-full text-center bg-green-600 hover:bg-green-700 text-white font-medium py-2 rounded-md transition">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="col-span-3 text-center text-gray-600">No motorcycles found.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
