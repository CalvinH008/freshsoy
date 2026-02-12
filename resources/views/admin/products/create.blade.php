<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        .btn-secondary {
            background: #6b7280;
        }

        .btn-secondary:hover {
            background: #4b5563;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .error {
            color: #ef4444;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container">

        {{-- Header --}}
        <div class="header">
            <h1>➕ Tambah Produk Baru</h1>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        {{-- Form --}}
        <div class="card">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                {{-- enctype="multipart/form-data" = WAJIB untuk upload file! --}}>
                @csrf
                {{-- @csrf = Token untuk proteksi CSRF attack --}}
                {{-- Laravel wajib pakai ini di semua form POST/PUT/DELETE --}}

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label for="name">Nama Produk *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Contoh: Laptop ASUS ROG">
                    {{-- old('name') = Ambil input lama kalau validasi gagal --}}

                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    {{-- @error = Tampilkan pesan error kalau validasi gagal --}}
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label for="description">Deskripsi *</label>
                    <textarea id="description" name="description" placeholder="Jelaskan detail produk...">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="form-group">
                    <label for="price">Harga (Rp) *</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}"
                        placeholder="Contoh: 15000000" min="0">

                    @error('price')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label for="category">Category *</label>
                    <input type="text" id="category" name="category" value="{{ old('category') }}"
                        placeholder="Contoh: Elektronik">

                    @error('category')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Size --}}
                <div class="form-group">
                    <label for="size">Size *</label>
                    <input type="text" id="size" name="size" value="{{ old('size') }}"
                        placeholder="Contoh: M / L / XL">

                    @error('size')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="form-group">
                    <label for="stock">Stok *</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock') }}"
                        placeholder="Contoh: 10" min="0">

                    @error('stock')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                {{-- FOTO --}}
                <div class="form-group">
                    <label for="image">Foto Produk </label>
                    <input type="file" 
                           id="image" 
                           name="image" 
                           accept="image/*">
                    <div class="hint">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                    
                    @error('image')
                        <div class="error">{{ $message }}</div>
                    @enderror
                {{-- Submit Button --}}
                <button type="submit" class="btn">💾 Simpan Produk</button>
            </form>
        </div>

    </div>
</body>

</html>
