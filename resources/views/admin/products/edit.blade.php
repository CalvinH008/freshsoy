<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product - Admin</title>
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

        .hint {
            color: #6b7280;
            font-size: 13px;
            margin-top: 5px;
        }

        .current-image {
            max-width: 200px;
            margin-top: 10px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>✏️ Edit Product: {{ $product->name }} </h1>
            <a href=" {{ route('admin.products.index') }} " class="btn btn-secondary">Back</a>
        </div>

        <div class="card">
            <form action=" {{ route('admin.products.update', $product->id) }} " method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Product Name * </label>
                    <input type="text" id="name" name="name" value=" {{ old('name', $product->name) }} ">
                    @error('name')
                        <div class="error"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description * </label>
                    <input type="text" id="description" name="description"
                        value=" {{ old('description', $product->description) }} ">
                    @error('description')
                        <div class="error"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price">Price (Rp) * </label>
                    <input type="number" id="price" name="price" value=" {{ old('price', $product->price) }} ">
                    @error('price')
                        <div class="error"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock * </label>
                    <input type="number" id="stock" name="stock" value=" {{ old('stock', $product->stock) }} ">
                    @error('stock')
                        <div class="error"> {{ $message }} </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Product Image * </label>
                    @if ($product->image)
                        <div style="margin-bottom: 10px;">
                            <strong>Foto saat ini:</strong><br>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="current-image">
                        </div>
                    @endif
                    <input type="file" id="image" name="image" accept="image/*">
                    <div class="hint">Kosongkan jika tidak ingin mengubah foto. Format: JPG, PNG, GIF. Maksimal 2MB.
                    </div>
                    @error('image')
                        <div class="error"> {{ $message }} </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn">💾 Update Produk</button>
            </form>
        </div>
    </div>
</body>

</html>
