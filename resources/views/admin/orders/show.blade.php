<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn { padding: 10px 20px; background: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn:hover { background: #2563eb; }
        .btn-secondary { background: #6b7280; }
        .btn-secondary:hover { background: #4b5563; }
        .btn-success { background: #10b981; }
        .btn-success:hover { background: #059669; }
        .btn-danger { background: #ef4444; }
        .btn-danger:hover { background: #dc2626; }
        
        .card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .card h2 { margin-bottom: 20px; border-bottom: 2px solid #e5e7eb; padding-bottom: 10px; }
        .info-row { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f3f4f6; }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #6b7280; font-weight: 500; }
        .info-value { font-weight: 600; }
        
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; font-weight: 600; }
        
        .status-badge { display: inline-block; padding: 6px 16px; border-radius: 20px; font-size: 14px; font-weight: 600; }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .status-cancelled { background: #fee2e2; color: #991b1b; }
        
        .total-row { background: #f9fafb; font-weight: 600; font-size: 18px; }
    </style>
</head>
<body>
    <div class="container">
        
        {{-- Header --}}
        <div class="header">
            <h1>Order #{{ $order->id }}</h1>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">← Back to Orders</a>
        </div>

        {{-- Order Info --}}
        <div class="card">
            <h2>Order Information</h2>
            
            <div class="info-row">
                <span class="info-label">Order ID:</span>
                <span class="info-value">#{{ $order->id }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Customer:</span>
                <span class="info-value">{{ $order->user->name }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $order->user->email }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Payment Method:</span>
                <span class="info-value">{{ ucfirst(str_replace('_', ' ', $order->payment_method ?? 'Not specified')) }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Order Date:</span>
                <span class="info-value">{{ $order->created_at->format('d M Y, H:i') }}</span>
            </div>
            
            <div class="info-row">
                <span class="info-label">Status:</span>
                <span class="info-value">
                    @if($order->status === 'pending')
                        <span class="status-badge status-pending">Pending</span>
                    @elseif($order->status === 'completed')
                        <span class="status-badge status-completed">Completed</span>
                    @else
                        <span class="status-badge status-cancelled">Cancelled</span>
                    @endif
                </span>
            </div>
        </div>

        {{-- Order Items --}}
        <div class="card">
            <h2>Ordered Products</h2>
            
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                    
                    <tr class="total-row">
                        <td colspan="3" style="text-align: right;">TOTAL:</td>
                        <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Update Status --}}
        <div class="card">
            <h2>Update Order Status</h2>
            
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div style="display: flex; gap: 10px; align-items: center;">
                    <label style="font-weight: 600;">Change Status:</label>
                    
                    <select name="status" style="padding: 10px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    
                    <button type="submit" class="btn btn-success">Update Status</button>
                </div>
            </form>
        </div>

    </div>
</body>
</html>