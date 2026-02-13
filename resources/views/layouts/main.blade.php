<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FreshSoy - Minuman Soya Segar')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-inter antialiased bg-white text-gray-900">

    <!-- NAVBAR (Clean Centered) -->
    <nav class="border-b border-gray-200 bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                <!-- Logo (Left) -->
                <a href="/" class="flex items-center space-x-3">

                    <!-- Logo -->
                    <img src="{{ asset('images/logo.jpg') }}" alt="Fresh Soy Logo" class="h-12 w-auto">

                    <!-- Brand Text -->
                    <span class="text-3xl font-extrabold"
                        style="
        font-family: 'Fredoka', sans-serif;
        color: #DC2626;
        letter-spacing: 1px;
        text-shadow: 2px 2px 0px #00000030;
    ">
                        FreshSoy
                    </span>

                </a>

                <!-- Menu (Center) -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors">HOME</a>
                    <a href="#products"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors scroll-link">PRODUCTS</a>
                    <a href="#about"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors scroll-link">ABOUT</a>
                    <a href="#contact"
                        class="text-sm font-medium text-gray-700 hover:text-gray-900 transition-colors scroll-link">CONTACT</a>
                </div>

                <!-- Actions (Right) -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Cart Icon -->
                        <a href="/cart" class="relative text-gray-700 hover:text-gray-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            @if (session('cart') && count(session('cart')) > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-green-600 text-white text-xs font-semibold rounded-full h-4 w-4 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>

                        <!-- User Menu -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-sm font-medium text-gray-700 hover:text-gray-900">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-transition
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg border border-gray-200 shadow-lg py-1">
                                <a href="{{ route('my.orders') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">My Orders</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="text-sm font-medium text-gray-700 hover:text-gray-900">Login</a>
                        <a href="/register"
                            class="bg-green-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-green-700 transition-colors shadow-lg shadow-green-600/30">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Alerts -->
    @if (session('success'))
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div
                class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">×</button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto px-6 mt-4">
            <div
                class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-600 hover:text-red-800">×</button>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer (Minimal) -->
    <footer class="border-t border-gray-200 mt-24">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid md:grid-cols-4 gap-8 text-sm">

                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('images/logo.jpg') }}" alt="FreshSoy" class="h-8">
                        <span class="font-semibold">FreshSoy</span>
                    </div>
                    <p class="text-gray-600 text-sm">Minuman soya segar untuk kesehatan keluarga.</p>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Product</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="/products" class="hover:text-gray-900">All Products</a></li>
                        <li><a href="/cart" class="hover:text-gray-900">Cart</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Company</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="#about" class="hover:text-gray-900">About</a></li>
                        <li><a href="#contact" class="hover:text-gray-900">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Contact</h3>
                    <ul class="space-y-2 text-gray-600 text-sm">
                        <li>info@freshsoy.com</li>
                        <li>0812-3456-7890</li>
                        <li>Pekanbaru, Riau</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-200 mt-8 pt-8 text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} FreshSoy. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Smooth Scroll Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scroll untuk semua anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');

                    // Skip kalau href cuma "#"
                    if (href === '#') return;

                    e.preventDefault();

                    const target = document.querySelector(href);
                    if (target) {
                        const navbarHeight = 64; // Height navbar (h-16 = 64px)
                        const targetPosition = target.getBoundingClientRect().top + window
                            .pageYOffset - navbarHeight;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</body>

</html>
