<div>
    <div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">My Profile</h2>

        <div wire:loading class="mb-4 text-blue-600">
            Processing...
        </div>

        <div class="grid grid-cols-1 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model.live="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model.live="email" id="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4">
            <button wire:click="updateProfile" wire:loading.attr="disabled" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 disabled:bg-gray-400">Update Profile</button>
        </div>
    </div>

    <!-- JavaScript untuk delay dan redirect -->
    <script>
        window.addEventListener('profile-updated', () => {
            // Optional: show a temporary loading alert
            alert('Profile updated! Redirecting...');
            setTimeout(() => {
                window.location.href = '/';
            }, 2000); // 2 seconds delay
        });
    </script>
</div>
