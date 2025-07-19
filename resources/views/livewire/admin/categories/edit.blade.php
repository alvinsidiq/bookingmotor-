<div class="bg-white shadow rounded-lg p-6 max-w-2xl mx-auto">
    <h2 class="text-2xl font-semibold mb-4">Edit Category</h2>
    <form wire:submit.prevent="update" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" wire:model="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea wire:model="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Icon</label>
                <input type="file" wire:model="icon" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @if ($category->icon)
                    <img src="{{ asset('storage/' . $category->icon) }}" class="mt-2 h-10 w-10 object-cover" />
                @endif
                @error('icon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" wire:model="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" class="mt-2 h-10 w-10 object-cover" />
                @endif
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Active</label>
                <input type="checkbox" wire:model="is_active" class="h-4 w-4 mt-2" />
                @error('is_active') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Sort Order</label>
                <input type="number" wire:model="sort_order" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" />
                @error('sort_order') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="{{ route('admin.categories.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
        </div>
    </form>
</div>
