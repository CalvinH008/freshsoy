<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Orders - FreshSoy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #4A6741;
            margin-bottom: 30px;
        }

        .order-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .order-id {
            font-size: 18px;
            font-weight: bold;
            color: #4A6741;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-processing {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .order-detail {
            margin: 10px 0;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px;
        }

        .btn {
            display: inline-block;
            padding: 8px 20px;
            background-color: #4A6741;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #2D3E28;
        }

        .empty-state {
            background: white;
            padding: 60px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>📦 My Orders</h1>
    @if ($orders->count() > 0)
        @foreach ($orders as $order)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                        <div style="font-size: 14px; color: #666; margin-top: 5px;">
                            {{ $order->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                    <div>
                        <span class="status-badge status-{{ $order->status }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <div class="order-detail">
                    <span class="label">Total Pembayaran:</span>
                    <span style="font-size: 18px; color: #4A6741; font-weight: bold;">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </span>
                </div>

                <div class="order-detail">
                    <span class="label">Metode Pembayaran:</span>
                    @if ($order->payment_method == 'bank_transfer')
                        🏦 Transfer Bank
                    @elseif($order->payment_method == 'e_wallet')
                        💳 E-Wallet
                    @else
                        💵 Cash on Delivery
                    @endif
                </div>

                <div class="order-detail">
                    <span class="label">Jumlah Item:</span>
                    {{ $order->items->count() }} produk
                </div>

                <a href="{{ route('checkout.success', $order->id) }}" class="btn">Lihat Detail →</a>
            </div>
        @endforeach
    @else
    @endif
</body>

</html>
