<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SOYA - Pure Goodness')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-soya-cream">
    {{-- Navbar --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                {{-- Logo --}}
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold text-soya-green tracking-wider">
                        FreshSoy
                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-gray-700 hover:text-soya-green transition duration-200 font-medium">
                        Home
                    </a>
                    <a href="/products" class="text-gray-700 hover:text-soya-green transition duration-200 font-medium">
                        Products
                    </a>
                    <a href="/about" class="text-gray-700 hover:text-soya-green transition duration-200 font-medium">
                        About
                    </a>
                    <a href="/contact" class="text-gray-700 hover:text-soya-green transition duration-200 font-medium">
                        Contact
                    </a>
                </div>

                {{-- Auth Links --}}
                <div class="hidden md:flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-soya-green transition duration-200 font-medium">
                        Login
                    </a>
                    <a href="/register" class="bg-soya-green text-white px-6 py-2 rounded-full hover:bg-soya-green-dark transition duration-200 font-medium">
                        Register
                    </a>
                </div>

                {{-- Mobile menu button --}}
                <div class="md:hidden">
                    <button type="button" class="text-gray-700 hover:text-soya-green focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-soya-green-dark text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">SOYA</h3>
                    <p class="text-gray-300 text-sm">
                        Minuman soya berkualitas tinggi dengan bahan alami terpilih.
                    </p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="/products" class="text-gray-300 hover:text-white">Products</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li>📧 info@soyashop.com</li>
                        <li>📱 +62 812-3456-7890</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-soya-green mt-8 pt-8 text-center text-sm text-gray-300">
                <p>&copy; 2024 SOYA Shop - Tugas Sekolah</p>
            </div>
        </div>
    </footer>

    @vite('resources/js/app.js')
</body>
</html>