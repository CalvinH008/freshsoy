<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin')</title>
    @vite('resources/css/app.css')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50 font-sans min-h-screen">
    <div x-data="{ open: true }" class="flex min-h-screen">
        <!-- SIDEBAR -->
        <aside :class="open ? 'w-64' : 'w-20'"
            class="bg-gradient-to-br from-white via-yellow-50 to-amber-100 shadow-lg border-r border-amber-200/50 transition-all duration-300 flex flex-col fixed h-screen z-50">

            <!-- TOP SECTION -->
            <div class="p-4 border-b border-amber-200/50">
                <!-- TOGGLE BUTTON -->
                <div class="flex justify-end mb-4">
                    <button @click="open = !open" class="p-2 rounded-md hover:bg-amber-100/50 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- BRAND -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Fresh Soy Logo" class="h-12 w-auto flex-shrink-0">
                    <div x-show="open" x-transition class="leading-tight">
                        <div class="text-2xl font-extrabold"
                            style="
                            font-family: 'Fredoka', sans-serif;
                            color: #DC2626;
                            letter-spacing: 1px;
                            text-shadow: 2px 2px 0px #00000030;
                        ">
                            FreshSoy
                        </div>
                        <div class="text-xs text-gray-600 tracking-wide">
                            Admin Panel
                        </div>
                    </div>
                </div>
            </div>

            <!-- NAVIGATION -->
            <nav class="p-4 space-y-2 text-sm flex-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                    {{ request()->routeIs('admin.dashboard')
                        ? 'bg-gradient-to-r from-amber-200 to-yellow-200 text-amber-900 font-semibold shadow-sm'
                        : 'hover:bg-amber-100/50 text-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span x-show="open" x-transition>Dashboard</span>
                </a>

                <a href="{{ route('admin.orders.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                    {{ request()->routeIs('admin.orders.*')
                        ? 'bg-gradient-to-r from-amber-200 to-yellow-200 text-amber-900 font-semibold shadow-sm'
                        : 'hover:bg-amber-100/50 text-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                    <span x-show="open" x-transition>Orders</span>
                </a>

                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition
                    {{ request()->routeIs('admin.products.*')
                        ? 'bg-gradient-to-r from-amber-200 to-yellow-200 text-amber-900 font-semibold shadow-sm'
                        : 'hover:bg-amber-100/50 text-gray-700' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    <span x-show="open" x-transition>Products</span>
                </a>
            </nav>

            <!-- BOTTOM SECTION -->
            <div class="p-4 border-t border-amber-200/50 space-y-2">
                <!-- BACK TO WEBSITE -->
                <a href="{{ url('/') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-amber-100/50 text-gray-700">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                    </svg>
                    <span x-show="open" x-transition>Back to Website</span>
                </a>

                <!-- LOGOUT -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-lg transition hover:bg-red-300 text-red-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span x-show="open" x-transition>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main :class="open ? 'ml-64' : 'ml-20'" class="flex-1 p-8 transition-all duration-300">
            @yield('content')
        </main>
    </div>
</body>

</html>
