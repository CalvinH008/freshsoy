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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">

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
                        class="text-base font-medium text-gray-700 hover:text-gray-900 transition-colors">HOME</a>
                    <a href="#products"
                        class="text-base font-medium text-gray-700 hover:text-gray-900 transition-colors scroll-link">PRODUCTS</a>
                    <a href="#about"
                        class="text-base font-medium text-gray-700 hover:text-gray-900 transition-colors scroll-link">ABOUT</a>
                    <a href="#contact"
                        class="text-base font-medium text-gray-700 hover:text-gray-900 transition-colors scroll-link">CONTACT</a>
                </div>

                <!-- Actions (Right) -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Cart Icon -->
                        <a href="/cart" class="relative text-gray-700 hover:text-gray-900">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1 5h12M9 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z">
                                </path>
                            </svg>
                            @if (session('cart') && count(session('cart')) > 0)
                                <span
                                    class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-semibold rounded-full h-4 w-4 flex items-center justify-center">
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
                                class="absolute right-0 mt-3 w-56 bg-white rounded-xl 
            border border-gray-200 shadow-xl 
            overflow-hidden">
                                {{-- ADMIN DASHBOARD --}}
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="flex items-center px-4 py-3 text-sm text-gray-700 
               hover:bg-gray-50 transition-colors group">

                                        <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-[#DC2626] transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m-4 0h8" />
                                        </svg>

                                        Store Management
                                    </a>

                                    <div class="border-t border-gray-100"></div>
                                @endif

                                <!-- My Orders -->
                                <a href="{{ route('my.orders') }}"
                                    class="flex items-center px-4 py-3 text-sm text-gray-700 
              hover:bg-gray-50 transition-colors group">

                                    <svg class="w-4 h-4 mr-3 text-gray-400 group-hover:text-[#DC2626] transition-colors"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5h6m-6 4h6m-6 4h6M5 5h.01M5 9h.01M5 13h.01M5 17h.01" />
                                    </svg>

                                    My Orders
                                </a>

                                <div class="border-t border-gray-100"></div>

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full flex items-center px-4 py-3 text-sm text-red-600 
                   hover:bg-red-50 transition-colors group">

                                        <svg class="w-4 h-4 mr-3 text-red-400 group-hover:text-red-600 transition-colors"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-10V5" />
                                        </svg>

                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="/login" class="text-sm font-medium text-gray-700 hover:text-gray-900">Login</a>
                        <a href="/register"
                            class="bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-red-700 transition-colors shadow-lg shadow-red-600/30">
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

    <!-- FOOTER (Updated Design) -->
    <footer class="bg-gradient-to-br from-white via-yellow-50 to-amber-100 border-t border-gray-200 mt-24">
        <div class="max-w-6xl mx-auto px-6 py-16">

            <div class="grid md:grid-cols-4 gap-10 mb-12">

                <!-- Brand -->
                <div class="md:col-span-1">
                    <div class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('images/logo.jpg') }}" alt="FreshSoy" class="h-10 w-auto">
                    </div>
                    <h3 class="text-2xl font-bold text-[#DC2626] mb-3"
                        style="font-family: 'Fredoka', sans-serif; letter-spacing: 0.5px;">
                        FreshSoy
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Fresh soy milk and tofu made daily with premium ingredients for your healthy lifestyle.
                    </p>
                </div>

                <!-- Products -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Products</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="/" class="text-gray-600 hover:text-[#DC2626] transition-colors">
                                All Products
                            </a>
                        </li>
                        <li>
                            <a href="/cart" class="text-gray-600 hover:text-[#DC2626] transition-colors">
                                Shopping Cart
                            </a>
                        </li>
                        <li>
                            <a href="#products" class="text-gray-600 hover:text-[#DC2626] transition-colors">
                                Browse Menu
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Company -->
                <div>
                    <h4 class="font-semibold text-gray-900 mb-4">Company</h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="#about" class="text-gray-600 hover:text-[#DC2626] transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="#contact" class="text-gray-600 hover:text-[#DC2626] transition-colors">
                                Contact
                            </a>
                        </li>
                        @auth
                            <li>
                                <a href="{{ route('my.orders') }}"
                                    class="text-gray-600 hover:text-[#DC2626] transition-colors">
                                    My Orders
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>

                <!-- Contact -->
                <div id="contact">
                    <h4 class="font-semibold text-gray-900 mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-sm text-gray-600">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 text-gray-500 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Batam, Kepulauan Riau</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>info@freshsoy.com</span>
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>08xx-xxxx-xxxx</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} FreshSoy. All rights reserved.</p>
                    <p class="text-xs tracking-wide uppercase">
                        Fresh & Healthy Lifestyle
                    </p>
                </div>
            </div>

        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Smooth Scroll Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const navbar = document.querySelector("nav");
            const navbarHeight = navbar.offsetHeight;

            document.querySelectorAll('a.scroll-link').forEach(link => {

                link.addEventListener("click", function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute("href");
                    const target = document.querySelector(targetId);

                    if (!target) return;

                    const targetPosition =
                        target.getBoundingClientRect().top +
                        window.pageYOffset -
                        navbarHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: "smooth"
                    });
                });

            });

        });
    </script>
    @stack('scripts')
</body>

</html>
