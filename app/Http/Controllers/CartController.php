<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // ambil cart dari session
        $cart = session()->get('cart', []);

        // hitung total harga
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        // validasi quantity
        $quantity = $request->input('quantity', 1);

        // Validasi quantity harus >= 1
        if ($quantity < 1) {
            $quantity = 1;
        }

        // cari product berdasarkan id
        $product = Product::find($id);

        // cek apakah ada product
        if (!$product) {
            // kalau produk gada return dengan pesan error
            return redirect()->back()->with('error', 'Product Not Found');
        }

        // ambil cart dari session kalau belum ada, buat array kosong
        $cart = session()->get('cart', []);

        // cek apakah produk sudah ada di cart
        if (isset($cart[$id])) {
            // kalau ada tambah quantity
            $cart[$id]['quantity']++;
        } else {
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

    public function update(Request $request, $id)
    {
        // validasi input
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100'
        ]);

        // ambil cart dari session
        $cart = session()->get('cart', []);

        // cek apakah ada produk di cart
        if (isset($cart[$id])) {
            // update quantity
            $cart[$id]['quantity'] = $request->quantity;

            // simpan ke session
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Quantity Updated Successfully');
        }

        return redirect()->back()->with('error', 'Product Not Found In Cart');
    }

    public function destroy($id)
    {
        // ambil cart dari session
        $cart = session()->get('cart', []);

        // cek apakah ada produk di cart
        if (isset($cart[$id])) {
            // simpan nama produk sebelum dihapus
            $productName = $cart[$id]['name'];

            // hapus dari cart
            unset($cart[$id]);

            // simpan ke session
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Product "' . $productName . '" Deleted Suscessfully');
        }

        return redirect()->back()->with('error', 'Product Not Found In Cart');
    }
}
