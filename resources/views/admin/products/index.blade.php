<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin</title>
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

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .btn {
            padding: 10px 20px;
            background: #3b82f6;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background: #2563eb;
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-small {
            padding: 6px 12px;
            font-size: 14px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
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

        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }

        .pagination .active {
            background: #3b82f6;
            color: white;
            border-color: #3b82f6;
        }
    </style>
</head>

<body>
    <div class="container">

        {{-- Header --}}
        <div class="header">
            <h1>📦 Kelola Produk</h1>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn">← Kembali ke Dashboard</a>
                <a href="{{ route('admin.products.create') }}" class="btn">+ Tambah Produk</a>
            </div>
        </div>

        {{-- Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Nama Produk</th>
                    <th>Category</th>
                    <th>Size</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" width="80">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->size }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            {{-- edit button --}}
                            <a
                                href=" {{ route('admin.products.edit', $product->id) }} "class="btn btn-warning btn-small">✏️
                                Edit
                            </a>

                            {{-- Form Delete --}}
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Yakin hapus produk {{ $product->name }}?')">
                                @csrf
                                @method('DELETE')
                                {{-- @method('DELETE') = spoofing method (form HTML cuma support GET/POST) --}}

                                <button type="submit" class="btn btn-danger btn-small">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 40px; color: #999;">
                            Belum ada produk. <a href="{{ route('admin.products.create') }}">Tambah produk pertama</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $products->links() }}
        </div>

    </div>
</body>

</html>
