<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // total semua order
        $totalOrders = Order::count();
        // order yang masi pending blm dibayar
        $pendingOrders = Order::where('status', 'pending')->count();
        // total revenue
        $totalRevenue = Order::where('status', 'completed')->sum('total') ?? 0;
        // total product di stock
        $totalProducts = Product::count();
        // order terbaru dari seluruh status
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        // kirim semua data ke view admin dashboard
        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'totalRevenue',
            'totalProducts',
            'recentOrders'
        ));
    }
}
