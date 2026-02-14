@extends('layouts.main')

@section('title', 'FreshSoy - Minuman Soya Segar')

@section('content')

    <!-- HERO -->
    <section
        class="relative overflow-hidden min-h-screen flex items-center justify-center 
           bg-gradient-to-br 
           from-white 
           via-yellow-50 
           to-amber-100 
           text-center px-6">

        <div class="max-w-3xl">

            <span class="text-xs tracking-[0.3em] uppercase text-green-600 font-medium">
                Fresh & Healthy Lifestyle
            </span>

            <h1 class="mt-6 text-4xl md:text-6xl leading-tight">
                <span class="text-[#DC2626]"
                    style="font-family: 'Fredoka', sans-serif; font-weight: 700; letter-spacing: 1px; text-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);">
                    FreshSoy
                </span>
                <span class="text-gray-50 font-semibold" style="text-shadow: 0 4px 12px rgba(0,0,0,0.35);">
                    Milk<br>
                    Made Every Morning
                </span>
            </h1>

            <p class="mt-8 text-gray-700 leading-relaxed text-base md:text-lg max-w-2xl mx-auto">
                Crafted daily using selected premium soybeans.
                Clean ingredients, hygienic process, and rich natural taste —
                made to support your healthy routine.
            </p>

            <div class="mt-12 flex justify-center gap-4">

                <a href=" {{ route('products.index') }} "
                    class="bg-[#DC2626] text-white px-8 py-3 rounded-md text-sm font-medium 
                       hover:bg-red-700 transition-all duration-300 shadow-sm">
                    Order Now
                </a>

                <a href="#about"
                    class="px-8 py-3 text-sm font-medium border border-gray-300 
                       text-gray-700 rounded-md 
                       hover:bg-red-600 hover:text-white 
                       transition-all duration-300">
                    Learn More
                </a>

            </div>

            <div class="mt-20">
                <div class="w-16 h-1 bg-red-600 mx-auto rounded-full"></div>
            </div>

        </div>
        <div class="absolute bottom-0 left-0 w-full h-40 
        bg-gradient-to-b from-transparent to-white">
        </div>
    </section>


    <!-- PRODUCTS -->
    <section id="products" class="py-24 bg-gradient-to-b from-white to-yellow-50/30">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-16">
                <span class="text-xs tracking-[0.3em] uppercase text-green-600 font-medium">
                    Our Collection
                </span>
                <h2 class="mt-4 text-3xl font-semibold text-gray-900">
                    Our Products
                </h2>
                <p class="text-gray-600 mt-3 text-sm">
                    Handcrafted daily with premium soybeans
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                @foreach ($products as $product)
                    <div x-data="{ open: false }"
                        class="bg-white border border-gray-200/60 rounded-xl p-6 
                           hover:shadow-lg hover:border-gray-300
                           transition-all duration-300">

                        @if ($product->image)
                            <div class="overflow-hidden rounded-lg">
                                <img src="{{ Storage::url($product->image) }}"
                                    class="w-full h-52 object-cover 
                                       hover:scale-105 transition-transform duration-500">
                            </div>
                        @endif

                        <h3 class="mt-5 text-lg font-semibold text-gray-900">
                            {{ $product->name }}
                        </h3>

                        <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                            Freshly made daily with selected soybeans
                        </p>

                        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                            <span class="text-lg font-semibold text-gray-900">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>

                            <button @click="open = true"
                                class="text-sm px-5 py-2 rounded-md 
                                    bg-[#DC2626] text-white font-medium
                                    transition-colors duration-300
                                    hover:bg-red-700">
                                View Detail
                            </button>
                        </div>

                        <!-- MODAL -->
                        <div x-show="open" class="fixed inset-0 bg-black/40 flex items-center justify-center z-50 px-4"
                            x-transition>

                            <div @click.away="open = false" class="bg-white w-full max-w-md rounded-xl p-8 shadow-2xl">

                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}"
                                        class="w-full h-56 object-cover rounded-lg mb-6">
                                @endif

                                <h3 class="text-xl font-semibold text-gray-900">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-gray-600 mt-4 text-sm leading-relaxed">
                                    This product is freshly prepared every morning using premium soybeans.
                                    High in protein and perfect for your healthy lifestyle.
                                </p>

                                <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between">
                                    <span class="text-xl font-semibold text-gray-900">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>

                                    <button @click="open = false"
                                        class="bg-[#DC2626] text-white px-6 py-2 rounded-md text-sm font-medium
                                           hover:bg-red-700 transition-all duration-300">
                                        Close
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
            <div class="mt-14 text-center">
                <a href="{{ route('products.index') }}"
                    class="group inline-flex items-center gap-3 px-8 py-3 text-sm font-semibold
              bg-[#DC2626] text-white rounded-lg
              transition-all duration-300
              hover:bg-red-700 hover:shadow-lg hover:-translate-y-0.5">

                    <!-- ICON KIRI -->
                    <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-12" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                    </svg>

                    View All Products
                </a>
            </div>
    </section>


    <!-- ABOUT -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-5xl mx-auto px-6 text-center">

            <span class="text-xs tracking-[0.3em] uppercase text-green-600 font-medium">
                Our Promise
            </span>
            <h2 class="mt-4 text-3xl font-semibold text-gray-900">
                Why Choose FreshSoy?
            </h2>

            <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed mt-6 mb-16">
                FreshSoy is committed to delivering high-quality soy products that are nutritious,
                hygienic, and made with passion every single day. Lorem ipsum dolor sit amet consectetur adipisicing elit. A
                facilis nesciunt neque modi veritatis incidunt nemo quisquam quia libero, pariatur quaerat minima assumenda
                itaque soluta eligendi praesentium sit? Quam distinctio inventore quaerat error doloribus impedit laborum
                magni alias vel beatae temporibus quia aliquid ipsa necessitatibus veniam odio dolores, atque nihil!
            </p>

            <div class="grid md:grid-cols-3 gap-10 text-left">

                <div class="space-y-4">
                    <div class="w-12 h-12 flex items-center justify-center bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5 13c4 0 7-3 7-7 4 0 7 3 7 7-4 0-7 3-7 7-4 0-7-3-7-7z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Premium Ingredients</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        We use selected high-quality soybeans to ensure rich taste and maximum nutrition.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="w-12 h-12 flex items-center justify-center bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3l8 4v5c0 5-3.5 9-8 9s-8-4-8-9V7l8-4z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Hygienic Process</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Our production follows strict hygiene standards to maintain freshness and safety.
                    </p>
                </div>

                <div class="space-y-4">
                    <div class="w-12 h-12 flex items-center justify-center bg-yellow-50 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 8a4 4 0 018 0 4 4 0 018 0c0 4-8 8-8 8s-8-4-8-8z" />
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900">Made With Care</h4>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Every product is made with dedication to support your healthy lifestyle.
                    </p>
                </div>

            </div>
        </div>
    </section>

@endsection
