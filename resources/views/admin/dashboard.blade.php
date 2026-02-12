<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            margin-bottom: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .stat-card p {
            font-size: 32px;
            font-weight: bold;
        }

        .stat-card.blue p {
            color: #3b82f6;
        }

        .stat-card.orange p {
            color: #f97316;
        }

        .stat-card.green p {
            color: #10b981;
        }

        .stat-card.purple p {
            color: #8b5cf6;
        }

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background: #f9fafb;
            font-weight: 600;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge.pending {
            background: #fef3c7;
            color: #92400e;
        }

        .badge.completed {
            background: #d1fae5;
            color: #065f46;
        }

        .badge.cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            background: #ef4444;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background: #dc2626;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- header --}}
        <div class="header">
            <h1>📊 Admin Dashboard</h1>
            <div>
                <span>Logged in as: <strong> {{ auth()->user()->name }} </strong></span>
                <form action=" {{ route('logout') }} " method="post" style="display: inline;">
                    @csrf
                    <a href="{{ route('admin.orders.index') }}" class="...">
                        🛒 Orders
                    </a>
                    <button type="submit" class="btn">Logout</button>
                </form>
            </div>
        </div>

        {{-- statistics card --}}
        <div class="stats">
            <div class="stat-card blue">
                <h3>📦 Total Orders</h3>
                <p> {{ $totalOrders }} </p>
            </div>
            <div class="stat-card orange">
                <h3>📦 Pending Orders</h3>
                <p> {{ $pendingOrders }} </p>
            </div>
            <div class="stat-card green">
                <h3>📦 Total Revenue</h3>
                <p> Rp. {{ number_format($totalRevenue, 0, ',', '.') }} </p>
            </div>
            <div class="stat-card purple">
                <h3>📦 Total Products</h3>
                <p> {{ $totalProducts }} </p>
            </div>
        </div>

        {{-- recent orders table --}}
        <h2 style="margin-bottom: 15px;">Recent Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order Id</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentOrders as $order)
                    <tr>
                        <td> {{ $order->id }} </td>
                        <td> {{ $order->user->name }} </td>
                        <td> Rp. {{ number_format($order->total, 0, ',', '.') }} </td>
                        <td>
                            @if ($order->status === 'pending')
                                <span class="badge pending">Pending</span>
                            @elseif ($order->status === 'completed')
                                <span class="badge completed">Completed</span>
                            @else
                                <span class="badge cancelled">Cancelled</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
                            Belum ada order
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
