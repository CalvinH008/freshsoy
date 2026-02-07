<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <style>
    body {
            font-family: Arial, sans-serif;
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
        }
        h1 {
            color: #4A6741;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4A6741;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <h1>Daftar produk</h1>
    <p>Total Produk: <strong> {{$products->count()}} </strong></p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category</th>
                <th>Size</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td> {{$product->id}} </td>
                <td> 
                    <a href="/products/{{ $product->id }}" style="color: #4A6741; text-decoration: none;">
                        {{ $product->name }}
                    </a> 
                </td>
                <td> {{$product->description}} </td>
                <td> Rp. {{number_format($product->price, 0, ',', '.')}} </td>
                <td> {{$product->category}} </td>
                <td> {{$product->size}} </td>
                <td> {{$product->stock}} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>