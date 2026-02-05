@extends('layouts.app')

@section('title', 'Home - SOYA Shop')

@section('content')
<section class="relative bg-gradient-to-b from-white to-soya-cream py-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-4">SOYA:</h1>
        <p class="text-2xl md:text-3xl text-soya-green font-light mb-12 italic">Pure Goodness</p>
        
        <div class="bg-green-50 border-2 border-green-400 rounded-xl p-6 max-w-lg mx-auto">
            <div class="text-4xl mb-3">✅</div>
            <h3 class="text-xl font-bold text-green-800 mb-2">Setup Berhasil!</h3>
            <p class="text-green-700">Laravel + Tailwind CSS sudah jalan!</p>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-xl bg-soya-cream">
                <div class="w-16 h-16 mx-auto mb-4 bg-soya-green rounded-full flex items-center justify-center">
                    <span class="text-3xl">🌱</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Natural Ingredients</h3>
                <p class="text-gray-600 text-sm">Dibuat dari kedelai pilihan berkualitas tinggi</p>
            </div>

            <div class="text-center p-6 rounded-xl bg-soya-cream">
                <div class="w-16 h-16 mx-auto mb-4 bg-soya-green rounded-full flex items-center justify-center">
                    <span class="text-3xl">🧪</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Premium Quality</h3>
                <p class="text-gray-600 text-sm">Proses produksi dengan standar terbaik</p>
            </div>

            <div class="text-center p-6 rounded-xl bg-soya-cream">
                <div class="w-16 h-16 mx-auto mb-4 bg-soya-green rounded-full flex items-center justify-center">
                    <span class="text-3xl">♻️</span>
                </div>
                <h3 class="text-xl font-semibold mb-2">Sustainable</h3>
                <p class="text-gray-600 text-sm">Kemasan ramah lingkungan</p>
            </div>
        </div>
    </div>
</section>
@endsection