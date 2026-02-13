@extends('layouts.main')

@section('title', 'FreshSoy - Minuman Soya Segar')

@section('content')

    <!-- HERO SECTION -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                <!-- Content -->
                <div>
                    <div class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium mb-4">
                        🌱 Fresh & Healthy
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Fresh Soy Milk,<br>
                        Delivered Daily
                    </h1>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        Premium quality soy milk and tofu products, made fresh every morning for your healthy lifestyle.
                    </p>
                    <div class="flex items-center space-x-4">
                        <a href="#products"
                            class="bg-green-600 text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-green-700 transition-colors shadow-lg shadow-green-600/30">
                            Shop Now
                        </a>
                        <a href="#about"
                            class="border-2 border-gray-300 text-gray-700 px-8 py-3.5 rounded-lg font-semibold hover:border-gray-400 hover:bg-gray-50 transition-all">
                            Learn More
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative">
                    <div class="absolute inset-0 bg-green-100 rounded-full blur-3xl opacity-20"></div>
                    <img src="{{ asset('images/hero.jpg') }}" alt="FreshSoy Product"
                        class="relative w-full max-w-lg mx-auto rounded-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- PRODUCTS SECTION -->
    <section id="products" class="py-20 bg-gradient-to-b from-white to-gray-50 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-3">Our Products</h2>
                <p class="text-gray-600 text-lg">Fresh soy milk & tofu, delivered to your door</p>
            </div>

            <!-- Products Grid (3 KOLOM) -->
            <div class="grid md:grid-cols-3 gap-8 mb-12">
                @foreach ($products as $product)
                    <div
                        class="bg-white rounded-xl border border-gray-100 overflow-hidden hover:shadow-2xl hover:border-gray-200 transition-all duration-300 group">

                        <!-- Image -->
                        <a href="/products/{{ $product->id }}" class="block">
                            <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden relative">
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <span class="text-6xl">🥛</span>
                                @endif

                                <!-- Stock Badge -->
                                @if ($product->stock > 0)
                                    <div
                                        class="absolute top-3 right-3 bg-green-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                                        In Stock
                                    </div>
                                @else
                                    <div
                                        class="absolute top-3 right-3 bg-red-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow-lg">
                                        Sold Out
                                    </div>
                                @endif
                            </div>
                        </a>

                        <!-- Info -->
                        <div class="p-5">
                            <a href="/products/{{ $product->id }}">
                                <h3
                                    class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-green-600 transition-colors">
                                    {{ $product->name }}
                                </h3>
                            </a>

                            <!-- Price & Size -->
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @if ($product->size)
                                    <span class="text-sm text-gray-500 bg-gray-100 px-2 py-1 rounded">
                                        {{ $product->size }}
                                    </span>
                                @endif
                            </div>

                            <!-- View Details Button -->
                            <a href="/products/{{ $product->id }}"
                                class="block w-full text-center bg-green-600 text-white py-2.5 rounded-lg font-semibold hover:bg-green-700 transition-colors shadow-lg shadow-green-600/20">
                                View Details
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- View All Button -->
            <div class="text-center">
                <a href="/products"
                    class="inline-flex items-center space-x-2 bg-gray-900 text-white px-8 py-3.5 rounded-lg font-semibold hover:bg-gray-800 transition-colors shadow-lg">
                    <span>View All Products</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6">
                        </path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ABOUT SECTION -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose FreshSoy?</h2>
                <p class="text-lg text-gray-600">Quality and freshness you can trust</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">100% Fresh</h3>
                    <p class="text-gray-600 text-sm">Made daily with premium ingredients</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Fast Delivery</h3>
                    <p class="text-gray-600 text-sm">Same-day delivery available</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Quality Assured</h3>
                    <p class="text-gray-600 text-sm">Certified and safe products</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="py-20 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Get in Touch</h2>
                <p class="text-lg text-gray-600">We're here to help with any questions</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <a href="mailto:info@freshsoy.com"
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-gray-200 hover:border-green-500 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-1">Email</h3>
                    <p class="text-sm text-gray-600">info@freshsoy.com</p>
                </a>

                <a href="tel:081234567890"
                    class="flex flex-col items-center p-6 bg-white rounded-xl border border-gray-200 hover:border-blue-500 hover:shadow-lg transition-all">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-1">Phone</h3>
                    <p class="text-sm text-gray-600">0812-3456-7890</p>
                </a>

                <div class="flex flex-col items-center p-6 bg-white rounded-xl border border-gray-200">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold mb-1">Location</h3>
                    <p class="text-sm text-gray-600">Pekanbaru, Riau</p>
                </div>
            </div>
        </div>
    </section>

@endsection
