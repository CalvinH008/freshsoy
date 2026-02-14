@extends('layouts.main')

@section('title', $product->name . ' - FreshSoy')

@section('content')

    <div class="bg-white min-h-screen">
        <div class="max-w-6xl mx-auto px-6 py-12">

            <!-- PRODUCT LAYOUT (2 Kolom Rapi) -->
            <div class="grid md:grid-cols-2 gap-16">

                <!-- LEFT: Image -->
                <div>
                    <div class="bg-gray-50 rounded-2xl p-12 border border-gray-100">
                        @if ($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                class="w-full rounded-xl">
                        @else
                            <div class="w-full aspect-square flex items-center justify-center text-8xl">
                                🥛
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT: Info -->
                <div>

                    <!-- Category Badge (Kecil & Simple) -->
                    <span class="inline-block text-xs text-gray-600 bg-gray-100 px-3 py-1 rounded-full mb-4">
                        {{ ucfirst($product->category ?? 'Product') }}
                    </span>

                    <!-- Product Name (Besar & Bold) -->
                    <h1 class="text-4xl font-bold text-gray-900 mb-3 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <!-- Price (Prominent) -->
                    <div class="mb-6">
                        <p class="text-4xl font-bold text-gray-900">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="text-sm font-semibold text-gray-900 mb-2">Description</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?? 'Fresh soy milk made daily with premium ingredients. High in protein and perfect for your healthy lifestyle.' }}
                        </p>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Specs (Grid 2 Kolom) -->
                    <div class="grid grid-cols-2 gap-4 mb-8">

                        @if ($product->size)
                            <div>
                                <p class="text-xs text-gray-500 mb-1">Size</p>
                                <p class="font-medium text-gray-900">{{ $product->size }}</p>
                            </div>
                        @endif

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Stock</p>
                            @if ($product->stock > 10)
                                <p class="font-medium text-green-600">In Stock</p>
                            @elseif($product->stock > 0)
                                <p class="font-medium text-yellow-600">Low Stock</p>
                            @else
                                <p class="font-medium text-red-600">Out of Stock</p>
                            @endif
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Category</p>
                            <p class="font-medium text-gray-900">{{ ucfirst($product->category ?? 'Beverage') }}</p>
                        </div>

                        <div>
                            <p class="text-xs text-gray-500 mb-1">Rating</p>
                            <div class="flex items-center space-x-1">
                                <span class="text-yellow-400 text-sm">★★★★★</span>
                                <span class="text-sm text-gray-500">(4.8)</span>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-6"></div>

                    <!-- Add to Cart -->
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf

                            <!-- Quantity (Simple & Clean) -->
                            <div class="mb-6">
                                <label class="text-sm font-medium text-gray-900 mb-3 block">Quantity</label>
                                <div class="flex items-center space-x-3">
                                    <button type="button" onclick="decreaseQty()"
                                        class="w-10 h-10 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 font-medium">
                                        −
                                    </button>
                                    <input type="number" name="quantity" id="quantity" value="1" min="1"
                                        max="{{ $product->stock }}"
                                        class="w-16 h-10 text-center border border-gray-300 rounded-lg font-medium text-gray-900">
                                    <button type="button" onclick="increaseQty({{ $product->stock }})"
                                        class="w-10 h-10 border border-gray-300 rounded-lg hover:bg-gray-50 text-gray-600 font-medium">
                                        +
                                    </button>
                                </div>
                            </div>

                            <!-- Buttons (Full Width) -->
                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full bg-red-600 text-white py-3.5 rounded-lg font-medium hover:bg-red-800 transition-colors">
                                    Add to Cart
                                </button>
                                <a href="/products"
                                    class="block w-full text-center border border-gray-300 text-gray-700 py-3.5 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                    Back to Products
                                </a>
                            </div>
                        </form>
                    @else
                        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                            This product is currently out of stock
                        </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Related Products (Section Terpisah) -->
        <div class="bg-gray-50 border-t border-gray-200 mt-20 py-16">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">You Might Also Like</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach (\App\Models\Product::where('id', '!=', $product->id)->inRandomOrder()->take(4)->get() as $related)
<a href="/products/{{ $related->id }}" class="group bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-gray-300 transition-colors">
                    <div class="aspect-square bg-gray-50 flex items-center justify-center overflow-hidden">
                        @if ($related->image)
<img src="{{ Storage::url($related->image) }}" 
                                 alt="{{ $related->name }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
@else
<span class="text-5xl">🥛</span>
@endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-medium text-gray-900 text-sm mb-2 line-clamp-2">{{ $related->name }}</h3>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($related->price, 0, ',', '.') }}</p>
                    </div>
                </a>
@endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        function increaseQty(max) {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current < max) input.value = current + 1;
        }

        function decreaseQty() {
            const input = document.getElementById('quantity');
            const current = parseInt(input.value);
            if (current > 1) input.value = current - 1;
        }
    </script>
@endpush)
