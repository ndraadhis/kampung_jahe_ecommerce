<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style type="text/css">
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            color: white !important;
            font-size: 16px;
            display: inline-block;
            width: 200px;
        }

        input[type='text'],
        input[type='number'],
        input[type='file'],
        select,
        textarea {
            width: 350px;
            height: 50px;
            margin-bottom: 20px;
            padding: 10px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        textarea {
            height: 80px;
            resize: vertical;
        }

        .input_deg {
            padding: 10px 0;
        }

        .btn-success {
            font-size: 16px;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">

                <h1>Tambah Produk</h1>

                <div class="div_deg">
                    <form action="{{ url('upload_product') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="input_deg">
                            <label for="title">Nama Produk</label>
                            <input type="text" id="title" name="title" required>
                        </div>

                        <div class="input_deg">
                            <label for="description">Deskripsi</label>
                            <textarea id="description" name="description" required></textarea>
                        </div>

                        <div class="input_deg">
                            <label for="price">Harga</label>
                            <input type="text" id="price" name="price" required>
                        </div>

                        <div class="input_deg">
                            <label for="qty">Jumlah Produk</label>
                            <input type="number" id="qty" name="qty" required>
                        </div>

                        <div class="input_deg">
                            <label for="category">Kategori Produk</label>
                            <select id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($category as $cat)
                                    <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input_deg">
                            <label for="image">Gambar Produk</label>
                            <input type="file" id="image" name="image" required>
                        </div>

                        <div class="input_deg">
                            <input type="submit" class="btn btn-success" value="Tambah Produk">
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    @include('admin.js')
</body>

</html>
