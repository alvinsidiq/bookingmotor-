<div class="bg-white shadow rounded-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Categories</h2>
       <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Category</a>

    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                    <th class="py-3 px-4">Name</th>
                    <th class="py-3 px-4">Slug</th>
                    <th class="py-3 px-4">Icon</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $category->name }}</td>
                        <td class="py-3 px-4">{{ $category->slug }}</td>
                        <td class="py-3 px-4">
                            @if ($category->icon)
                                <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}" class="h-10 w-10 object-cover">
                            @else
                                No Icon
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <span class="{{ $category->is_active ? 'text-green-600' : 'text-red-600' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-3 px-4">
                          <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:underline">Edit</a>

                            <button wire:click.prevent="delete({{ $category->id }})" class="text-red-600 hover:underline ml-2">
                            Delete
                        </button>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-3 px-4 text-center">No categories found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
