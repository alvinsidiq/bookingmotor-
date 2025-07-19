<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Vite (Laravel 11) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Optional: Fonts or Icons --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans text-gray-900">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="bg-gray-900 text-white w-64 p-4 hidden md:block">
            <div class="text-2xl font-bold mb-6">Motorcycle Booking</div>
            <nav>
<ul>
    <li>
        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Dashboard
        </a>
    </li>
    <li>
        <a href="{{ route('admin.categories.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Categories
        </a>
    </li>
    <li>
        <a href="{{ route('admin.brands.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Brands
        </a>
    </li>
    <li>
        <a href="{{ route('admin.locations.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Locations
        </a>
    </li>
    <li>
        <a href="{{ route('admin.promocodes.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Promocodes
        </a>
    </li>
    <li>
        <a href="{{ route('admin.motorcycles.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Motorcycles
        </a>
    </li>
    <li>
        <a href="{{ route('admin.users.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Users
        </a>
    </li>
    <li>
        <a href="{{ route('admin.bookings.index') }}" class="block py-2 px-4 hover:bg-gray-800 rounded">
            Bookings
        </a>
    </li>
</ul>



            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow p-4 flex justify-between items-center">
                <div class="text-lg font-semibold">Admin Panel</div>
                <div class="flex items-center gap-4">
                    <span>{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
