<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        // ambil cart dari session
        $cart = session()->get('cart', []);

        // kalau cart kosong, direct ke products
        if (count($cart) == 0) {
            return redirect('/products')->with('error', 'Your Cart Is Empty');
        }

        // hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('checkout.index', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,e-wallet,cod'
        ]);

        // ambil cart dari session
        $cart = session()->get('cart', []);

        // cek jika cart kosong
        if (count($cart) == 0) {
            return redirect('/products')->with('error', 'Your Cart Is Empty');
        }

        // hitung total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // database transaction
        DB::beginTransaction();

        try {
            // simpan order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method
            ]);

            // simpan order items
            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            // commit transaction
            DB::commit();

            // kosongkan cart
            session()->forget('cart');

            // direct ke halaman sukses
            return redirect()->route('checkout.index', $order->id)->with('success', 'Order Created Successfully');
        } catch (\Exception $error) {
            // rollback kalau ada error
            DB::rollBack();

            return redirect()->back()->with('error', 'Something Went Wrong: ' . $error->getMessage());
        }
    }

    public function success($orderid)
    {
        $order = Order::with('items.product')->findOrFail($orderid);

        // pastikan order memilih user yang login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'unathorized');
        }

        return view('checkout.success', compact('order'));
    }
}
