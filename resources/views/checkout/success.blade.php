<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Berhasil - Soya Shop</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-icon {
            font-size: 80px;
            color: #4A6741;
            margin-bottom: 20px;
        }
        h1 {
            color: #4A6741;
            margin-bottom: 10px;
        }
        .order-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            text-align: left;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #dee2e6;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .label {
            font-weight: bold;
            color: #555;
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        th {
            background-color: #f8f9fa;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4A6741;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #2D3E28;
        }
        .btn-secondary {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="success-icon">✅</div>
        <h1>Pesanan Berhasil Dibuat!</h1>
        <p style="color: #666; font-size: 18px;">Terima kasih telah berbelanja di Soya Shop</p>

        <div class="order-info">
            <div class="info-row">
                <span class="label">Nomor Order:</span>
                <span>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div class="info-row">
                <span class="label">Total Pembayaran:</span>
                <span style="font-size: 20px; color: #4A6741; font-weight: bold;">
                    Rp {{ number_format($order->total, 0, ',', '.') }}
                </span>
            </div>
            <div class="info-row">
                <span class="label">Metode Pembayaran:</span>
                <span>
                    @if($order->payment_method == 'bank_transfer')
                        🏦 Transfer Bank
                    @elseif($order->payment_method == 'e_wallet')
                        💳 E-Wallet
                    @else
                        💵 Cash on Delivery
                    @endif
                </span>
            </div>
            <div class="info-row">
                <span class="label">Status:</span>
                <span style="color: #856404; background: #fff3cd; padding: 5px 15px; border-radius: 20px;">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
        </div>

        <h3 style="color: #4A6741; margin-top: 30px;">Detail Pesanan</h3>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
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
            </tbody>
        </table>

        @if($order->payment_method == 'bank_transfer')
        <div style="background: #d1ecf1; border: 1px solid #bee5eb; padding: 20px; border-radius: 8px; margin: 20px 0; text-align: left;">
            <h4 style="color: #0c5460; margin-top: 0;">Instruksi Pembayaran</h4>
            <p>Silakan transfer ke rekening berikut:</p>
            <p style="font-weight: bold;">
                BCA: 1234567890<br>
                a.n. FreshSoy
            </p>
            <p style="font-size: 14px; color: #666;">
                Konfirmasi pembayaran akan diproses maksimal 1x24 jam
            </p>
        </div>
        @endif

        <div style="margin-top: 30px;">
            <a href="/products" class="btn">Lanjut Belanja</a>
            <a href="{{ route('my.orders') }}" class="btn btn-secondary">Lihat Pesanan Saya</a>
        </div>
    </div>
</body>
</html>