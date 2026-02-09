<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout - FreshSoy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        h1 {
            color: #4A6741;
            margin-bottom: 30px;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .total-row {
            background-color: #f5f5f5;
            font-weight: bold;
            font-size: 18px;
        }

        .payment-method {
            margin: 20px 0;
        }

        .payment-option {
            display: block;
            padding: 15px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .payment-option:hover {
            border-color: #4A6741;
            background-color: #f8f9fa;
        }

        .payment-option input[type="radio"] {
            margin-right: 10px;
        }

        .btn {
            display: inline-block;
            padding: 15px 40px;
            background-color: #4A6741;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
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
    <h1>🛒 Checkout</h1>

    @if (session('error'))
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            ❌ {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <strong>Error:</strong>
            <ul style="margin: 10px 0 0 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ringkasan order --}}
    <div class="container">
        <h2 style="color: #4A6741; margin-top: 0;">Ringkasan Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <td>Product</td>
                    <td>Harga</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                    <tr>
                        <td> {{ $item['name'] }} </td>
                        <td> {{ number_format($item['price'], 0, ',', '.') }} </td>
                        <td> {{ $item['quantity'] }} </td>
                        <td> {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} </td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">TOTAL: </td>
                    <td>Rp. {{ number_format($total, 0, ',', '.') }} </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- form checkout --}}
    <div class="container">
        <h2 style="color: #4A6741; margin-top: 0;">Pilih Metode Pembayaran</h2>
        <form action=" {{ route('checkout.store') }} " method="post">
            @csrf
            <div class="payment-method">
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="bank_transfer" required>
                    <strong>🏦 Transfer Bank</strong>
                    <p style="margin: 5px 0 0 30px; color: #666; font-size: 14px;">
                        BCA, BRI, Mandiri
                    </p>
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment_method" value="e_wallet" required>
                    <strong>💳 E-Wallet</strong>
                    <p style="margin: 5px 0 0 30px; color: #666; font-size: 14px;">
                        GoPay, OVO, Dana, ShopeePay
                    </p>
                </label>

                <label class="payment-option">
                    <input type="radio" name="payment_method" value="cod" required>
                    <strong>💵 Cash on Delivery (COD)</strong>
                    <p style="margin: 5px 0 0 30px; color: #666; font-size: 14px;">
                        Bayar saat produk diterima
                    </p>
                </label>
            </div>
            <div style="margin-top: 30px;">
                <a href="/cart" class="btn btn-secondary">← Kembali ke Keranjang</a>
                <button type="submit" class="btn">Proses Pesanan →</button>
            </div>
        </form>
    </div>
</body>

</html>
