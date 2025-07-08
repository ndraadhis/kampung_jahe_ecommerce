<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')

    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        h1 {
            color: white;
        }

        label {
            color: white !important;
            font-size: 18px !important;
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
            font-size: 16px;
        }

        textarea {
            width: 350px;
            height: 80px;
        }

        .input_deg {
            padding: 15px;
            margin: 10px 0;
        }

        .btn {
            margin-top: 20px;
        }
    </style>
</head>

<body>

    @include('admin.header')
    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 class="text-center">Tambah Produk</h1>

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
                                @foreach($category as $category)
                                    <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
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

    <!-- JavaScript -->
    @include('admin.js')
</body>

</html>
