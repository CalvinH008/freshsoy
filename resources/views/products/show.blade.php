@extends('layouts.main')

@section('title', $product->name . ' - Fresh Soy')

@section('content')

{{-- Breadcrumb --}}
<div class="bg-gray-100 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center space-x-2 text-sm text-gray-600">
            <a href="/" class="hover:text-primary-500 transition">Home</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-primary-500 transition">Menu</a>
            <span>/</span>
            <span class="text-gray-900 font-medium">{{ Str::limit($product->name, 30) }}</span>
        </div>
    </div>
</div>

{{-- Product Detail --}}
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            
            {{-- Left: Product Image --}}
            <div>
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-24">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-auto object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <i class="fas fa-image text-gray-400 text-6xl"></i>
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- Right: Product Info --}}
            <div>
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    
                    {{-- Product Name --}}
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        {{ $product->name }}
                    </h1>
                    
                    {{-- Price --}}
                    <div class="mb-6">
                        <span class="text-5xl font-bold text-primary-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    {{-- Stock --}}
                    <div class="mb-6">
                        @if($product->stock > 10)
                            <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full">
                                <i class="fas fa-check-circle mr-2"></i>
                                In Stock ({{ $product->stock }} available)
                            </span>
                        @elseif($product->stock > 0)
                            <span class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-800 rounded-full">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                Low Stock ({{ $product->stock }} left)
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-full">
                                <i class="fas fa-times-circle mr-2"></i>
                                Out of Stock
                            </span>
                        @endif
                    </div>
                    
                    {{-- Description --}}
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-3">Description</h2>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description }}
                        </p>
                    </div>
                    
                    {{-- Add to Cart Form --}}
                    @auth
                        @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                            @csrf
                            
                            {{-- Quantity Selector --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity</label>
                                <div class="flex items-center space-x-4">
                                    <button type="button" 
                                            onclick="decrementQty()" 
                                            class="w-12 h-12 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold text-xl transition">
                                        −
                                    </button>
                                    <input type="number" 
                                           name="quantity" 
                                           id="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->stock }}" 
                                           class="w-20 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg py-2">
                                    <button type="button" 
                                            onclick="incrementQty()" 
                                            class="w-12 h-12 bg-gray-200 hover:bg-gray-300 rounded-lg font-bold text-xl transition">
                                        +
                                    </button>
                                </div>
                            </div>
                            
                            {{-- Add to Cart Button --}}
                            <button type="submit" class="w-full btn-primary text-lg py-4">
                                <i class="fas fa-shopping-cart mr-2"></i>
                                Add to Cart
                            </button>
                        </form>
                        @else
                        <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-4 rounded-full cursor-not-allowed">
                            Out of Stock
                        </button>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="block w-full btn-primary text-center text-lg py-4">
                            <i class="fas fa-lock mr-2"></i>
                            Login to Purchase
                        </a>
                    @endauth
                    
                    {{-- Product Meta --}}
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-center">
                                <i class="fas fa-tag text-primary-500 mr-3"></i>
                                <span>Product ID: <strong>#{{ $product->id }}</strong></span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-shield-alt text-primary-500 mr-3"></i>
                                <span>100% Authentic Product</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-truck text-primary-500 mr-3"></i>
                                <span>Fast & Secure Delivery</span>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
            
        </div>
        
    </div>
</section>

{{-- Related Products (Optional) --}}
<section class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
            You May Also Like
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @php
                $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)
                                                       ->take(4)
                                                       ->get();
            @endphp
            
            @foreach($relatedProducts as $related)
            <a href="{{ route('products.show', $related->id) }}" class="product-card group">
                <div class="relative overflow-hidden">
                    @if($related->image)
                        <img src="{{ asset('storage/' . $related->image) }}" 
                             alt="{{ $related->name }}" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition duration-500">
                    @else
                        <div class="w-full h-48 bg-gray-200"></div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-1">{{ $related->name }}</h3>
                    <p class="text-lg font-bold text-primary-600">
                        Rp {{ number_format($related->price, 0, ',', '.') }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Quantity Selector Logic
const qtyInput = document.getElementById('quantity');
const maxQty = {{ $product->stock }};

function incrementQty() {
    let currentVal = parseInt(qtyInput.value) || 1;
    if (currentVal < maxQty) {
        qtyInput.value = currentVal + 1;
    }
}

function decrementQty() {
    let currentVal = parseInt(qtyInput.value) || 1;
    if (currentVal > 1) {
        qtyInput.value = currentVal - 1;
    }
}

// Prevent manual input over stock
qtyInput.addEventListener('input', function() {
    let val = parseInt(this.value) || 1;
    if (val > maxQty) this.value = maxQty;
    if (val < 1) this.value = 1;
});
</script>
@endpush