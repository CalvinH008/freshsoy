<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $product->name }} - FreshSoy </title>
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
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #4A6741;
            margin-bottom: 10px;
        }

        .badge {
            display: inline-block;
            padding: 5px 15px;
            background-color: #4A6741;
            color: white;
            border-radius: 20px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .detail-row {
            margin: 15px 0;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            font-weight: bold;
            color: #555;
            display: inline-block;
            width: 150px;
        }

        .price {
            font-size: 28px;
            color: #4A6741;
            font-weight: bold;
            margin: 20px 0;
        }

        .stock {
            padding: 8px 15px;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }

        .stock-available {
            background-color: #d4edda;
            color: #155724;
        }

        .stock-low {
            background-color: #fff3cd;
            color: #856404;
        }

        .stock-out {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4A6741;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #2D3E28;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- Flash Messages --}}
        @if (session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                ❌ {{ session('error') }}
            </div>
        @endif

        {{-- Link ke Cart --}}
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="{{ route('cart.index') }}" style="color: #4A6741; text-decoration: none; font-weight: bold;">
                🛒 Your Cart
            </a>
        </div>

        <h1> {{ $product->name }} </h1>

        <span class="badge"> {{ $product->category }} </span>

        <div class="price">
            Rp. {{ number_format($product->price, 0, ',', '.') }}
        </div>

        <div class="detail-row">
            <span class="label">Size</span>
            {{ $product->size ?? 'No Size Info' }}
        </div>

        <div class="detail-row">
            <span class="label">Stock: </span>
            @if ($product->stock > 10)
                <span class="stock stock-available">Tersedia {{ $product->stock }} </span>
            @elseif ($product->stock > 0)
                <span class="stock stock-low">Stok Terbatas {{ $product->stock }} </span>
            @else
                <span class="stock stock-out">Habis</span>
            @endif
        </div>

        <div class="detail-row">
            <span class="label">Ditambahkan:</span>
            {{ $product->created_at->format('d M Y, H:i') }}
        </div>

        <a href="/products" class="btn btn-secondary">← Kembali ke Daftar Produk</a>

        @if ($product->stock > 0)
            <form action=" {{ route('cart.add', $product->id) }} " method="post">
                @csrf
                <button type="submit" class="btn">Add To Cart</button>
            </form>
        @endif
    </div>
</body>

</html>
