<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1400px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn { padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #2563eb; }
        .btn-secondary { background: #6b7280; }
        .btn-secondary:hover { background: #4b5563; }
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 6px; }
        .alert-success { background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; }
        
        /* Filter Tabs */
        .filter-tabs { display: flex; gap: 10px; margin-bottom: 20px; background: white; padding: 15px; border-radius: 8px; }
        .filter-tabs a { padding: 10px 20px; border-radius: 6px; text-decoration: none; color: #4b5563; font-weight: 500; transition: all 0.3s; }
        .filter-tabs a:hover { background: #f3f4f6; }
        .filter-tabs a.active { background: #3b82f6; color: white; }
        .badge { background: #e5e7eb; color: #4b5563; padding: 2px 8px; border-radius: 12px; font-size: 12px; margin-left: 5px; }
        .filter-tabs a.active .badge { background: white; color: #3b82f6; }
        
        table { width: 100%; background: white; border-collapse: collapse; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #f9fafb; font-weight: 600; }
        
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="container">
        
        {{-- Header --}}
        <div class="header">
            <h1>🛒 Manage Orders</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">← Dashboard</a>
        </div>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Filter Tabs --}}
        <div class="filter-tabs">
            <a href="{{ route('admin.orders.index') }}" 
               class="{{ !request('status') ? 'active' : '' }}">
                All Orders <span class="badge">{{ $countAll }}</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
               class="{{ request('status') === 'pending' ? 'active' : '' }}">
                Pending <span class="badge">{{ $countPending }}</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'completed']) }}" 
               class="{{ request('status') === 'completed' ? 'active' : '' }}">
                Completed <span class="badge">{{ $countCompleted }}</span>
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}" 
               class="{{ request('status') === 'cancelled' ? 'active' : '' }}">
                Cancelled <span class="badge">{{ $countCancelled }}</span>
            </a>
        </div>

        {{-- Table --}}
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Payment Method</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong>#{{ $order->id }}</strong></td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? '-')) }}</td>
                    <td><strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong></td>
                    <td>
                        @if($order->status === 'pending')
                            <span class="status-badge status-pending">Pending</span>
                        @elseif($order->status === 'completed')
                            <span class="status-badge status-completed">Completed</span>
                        @else
                            <span class="status-badge status-cancelled">Cancelled</span>
                        @endif
                    </td>
                    <td>{{ $order->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn" style="padding: 6px 12px; font-size: 14px;">
                            View Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px; color: #999;">
                        No orders found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div style="margin-top: 20px;">
            {{ $orders->appends(['status' => request('status')])->links() }}
            {{-- appends() = keep query string saat pagination --}}
        </div>

    </div>
</body>
</html>