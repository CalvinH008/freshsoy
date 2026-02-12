<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // ambil parameter status dari url
        $status = $request->get('status');
        // mulai query eager loading
        $query = Order::with('user');

        // filter berdasarkan status
        if ($status && in_array($status, ['pending', 'completed', 'cancelled'])) {
            // in_array() = cek apakah $status valid
            $query->status($status);
        }

        $orders = $query->latest()->paginate(15);

        //  hitung statistik
        $countPending = Order::pending()->count();
        $countCompleted = Order::completed()->count();
        $countCancelled = Order::cancelled()->count();
        $countAll = Order::count();

        // kirim ke view
        return view('admin.orders.index', compact(
            'orders',
            'status',
            'countPending',
            'countCompleted',
            'countCancelled',
            'countAll'
        ));
    }

    public function show(string $id)
    {
        // ambil order
        $order = Order::with([
            'user',
            'items.product'
        ])->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, string $id) {
        // validasi
         $validated = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        // cari order
        $order = Order::findOrFail($id);

        // update status
        $order->update([
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Order Status Updated Suscessfully!');
    }
}
