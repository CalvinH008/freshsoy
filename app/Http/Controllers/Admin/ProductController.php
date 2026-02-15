<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // query builder buat search
        $query = Product::latest();

        // ambil input pencarian
        $search = $request->get('search');

        // filter pencarian
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('price', $search); // kalau mau exact match
            });
        }
        // ambil produk dan urutkan yang paling baru
        $products = $query->paginate(10);
        // kirim ke view
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // tampilin form kosong
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi user    
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'size' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product Added Suscessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari product berdasarkan ID
        // findOrFail() = kalau gak ketemu, otomatis 404
        $product = Product::findOrFail($id);

        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // cari product
        $product = Product::findOrFail($id);

        // validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        // ubah foto baru jika user upload foto yang baru
        if ($request->hasFile('image')) {
            // hapus foto lama jika ada
            if ($product->image) {
                // Storage::delete() = hapus file dari storage
                // Parameter: path file (contoh: products/abc123.jpg)
                Storage::disk('public')->delete($product->image);
            }

            // simpan foto baru
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // simpan perubahan
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // cari product
        $product = Product::findOrFail($id);

        // hapus foto jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // hapus dari db
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product Deleted Successfully');
    }
}
