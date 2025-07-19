<div class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        {{-- Header --}}
        <div class="text-center">
            <h1 class="text-4xl font-bold text-blue-700">Hubungi Kami</h1>
            <p class="mt-4 text-gray-600 text-lg">
                Ada pertanyaan atau butuh bantuan? Kami siap membantu Anda kapan saja.
            </p>
        </div>

        {{-- Contact Info --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-700">
            <div class="space-y-4">
                <h2 class="text-2xl font-semibold text-blue-600">Informasi Kontak</h2>
                <p><strong>📍 Alamat:</strong> Jl. Sudirman No. 88, Jakarta</p>
                <p><strong>📞 Telepon:</strong> +62 812 3456 7890</p>
                <p><strong>📧 Email:</strong> <a href="mailto:info@moto-rent.com" class="text-blue-500 underline">info@moto-rent.com</a></p>
                <p><strong>⏰ Jam Operasional:</strong> Setiap hari, 08.00 - 22.00 WIB</p>
            </div>

            {{-- Contact Form --}}
            <div class="bg-gray-50 p-6 rounded-lg shadow">
                @if ($success)
                    <div class="mb-4 p-4 bg-green-100 border border-green-300 rounded text-green-800">
                        Pesan Anda telah berhasil dikirim! Kami akan segera menghubungi Anda.
                    </div>
                @endif

                <form wire:submit.prevent="send" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" id="name" wire:model.defer="name" class="w-full p-2 border rounded" />
                        @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" wire:model.defer="email" class="w-full p-2 border rounded" />
                        @error('email') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Pesan</label>
                        <textarea id="message" wire:model.defer="message" rows="4" class="w-full p-2 border rounded"></textarea>
                        @error('message') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
