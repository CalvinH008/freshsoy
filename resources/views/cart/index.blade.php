<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart - FreshSoy</title>
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

        table {
            width: 100%;
            background: white;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #4A6741;
            color: white;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .empty-cart {
            background: white;
            padding: 60px 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .empty-cart p {
            color: #666;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .total-row {
            background-color: #f5f5f5;
            font-weight: bold;
            font-size: 18px;
        }

        .total-row td {
            border-bottom: none;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: #4A6741;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            margin-right: 10px;
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

        .quantity {
            font-weight: bold;
            color: #4A6741;
        }
    </style>
</head>

<body>
    <h1>Cart</h1>

    @if (session('success'))
        <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if (count($cart) > 0)
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $id => $item)
                    <tr>
                        <td> {{ $item['name'] }} </td>
                        <td> Rp. {{ number_format($item['price'], 0, ',', '.') }} </td>
                        <td>
                            {{-- Form Update Quantity --}}
                            <form action="{{ route('cart.update', $id) }}" method="POST"
                                style="display: flex; gap: 10px; align-items: center;">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    max="100"
                                    style="width: 60px; padding: 5px; border: 1px solid #ddd; border-radius: 5px;">
                                <button type="submit"
                                    style="background: #4A6741; color: white; border: none; padding: 6px 12px; border-radius: 5px; cursor: pointer;">
                                    Update
                                </button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                        <td>
                            {{-- Form Delete --}}
                            <form action="{{ route('cart.destroy', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                    style="background: #dc3545; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">TOTAL:</td>
                    <td>Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <div class="empty-cart">
            <p style="font-size: 48px; margin-bottom: 20px;">🛒</p>
            <p>Keranjang belanja kamu masih kosong</p>
            <a href="/products" class="btn">Belanja Sekarang</a>
        </div>
    @endif
</body>

</html>
