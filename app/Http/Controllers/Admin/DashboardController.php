<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Revenue (dari completed orders)
        $totalRevenue = Order::where('status', 'completed')->sum('total');

        // Total Orders
        $totalOrders = Order::count();

        // Pending Orders
        $pendingOrders = Order::where('status', 'pending')->count();

        // Total Products
        $totalProducts = Product::count();

        // Recent Orders (5 terakhir)
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Top Products dengan order count dan revenue
        // PERBAIKAN: Pakai order_items bukan order_product
        $topProducts = DB::table('products')
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.stock',
                DB::raw('COALESCE(COUNT(order_items.id), 0) as orders_count'),
                DB::raw('COALESCE(SUM(order_items.quantity * order_items.price), 0) as total_revenue')
            )
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function ($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed');
            })
            ->groupBy('products.id', 'products.name', 'products.price', 'products.stock')
            ->orderByDesc('orders_count')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'pendingOrders',
            'totalProducts',
            'recentOrders',
            'topProducts'
        ));
    }
}
