<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Booking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-xl font-bold text-gray-800">Motorcycle Booking</a>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- <a href="/" class="text-gray-600 hover:text-blue-600">Home</a> -->
                    <a href="/motorcycles" class="text-gray-600 hover:text-blue-600">Motorcycles</a>
                    <!-- <a href="{{ route('frontend.about') }}" class="text-gray-700 hover:text-blue-600">About</a>
                    <a href="{{ route('frontend.contact') }}" class="text-gray-700 hover:text-blue-600">Contact</a>

                    <a href="{{ route('frontend.profile') }}" class="text-gray-600 hover:text-blue-600">Profile</a> -->
                    <a href="{{ route('frontend.bookings') }}" class="text-gray-600 hover:text-blue-600">My Bookings</a>
                    @auth
                        <span class="text-gray-800">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-10">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="max-w-7xl mx-auto text-center">
            <p>© 2025 Motorcycle Booking. All rights reserved.</p>
            <p>Email: support@motorcyclebooking.com | Phone: +62 123 456 7890</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>