<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request, $id){
        // cari product berdasarkan id
        $product = Product::find($id);
        
        // cek apakah ada product
        if(!$product){
            // kalau produk gada return dengan pesan error
            return redirect()->back()->with('error', 'Product Not Found');
        }

        // ambil cart dari session kalau belum ada, buat array kosong
        $cart = session()->get('cart', []);

        // cek apakah produk sudah ada di cart
        if(isset($cart[$id])){
            // kalau ada tambah quantity
            $cart[$id]['quantity']++;
        }else{
            // kalau belum ada, tambah produk ke cart
            $cart[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // simpan cart ke session
        session()->put('cart', $cart);

        // redirect dan return alert sukses
        return redirect()->back()->with('success', 'Product add successfully');
    }
}
