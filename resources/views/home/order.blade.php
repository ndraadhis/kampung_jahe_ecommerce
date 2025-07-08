<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pesanan Saya</title>
    @include('home.css')

    <style type="text/css">
        .div_center {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
            flex-direction: column;
        }
        table {
            border: 2px solid black;
            text-align: center;
            width: 90%;
            max-width: 1000px;
        }
        th {
            border: 2px solid black;
            background-color: black;
            color: white;
            font-size: 19px;
            font-weight: bold;
            text-align: center;
        }
        td {
            border: 1px solid black;
            padding: 10px;
        }
        .logout-form {
            margin-top: 40px;
        }
        .logout-form input {
            padding: 8px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .logout-form input:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
<div class="hero_area">
    <!-- Header -->
    @include('home.header')

    <!-- Orders Table -->
    <div class="div_center">
        <h2>Pesanan Anda</h2>
        <table>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Status Pengiriman</th>
                <th>Gambar</th>
            </tr>
            @foreach($order as $order)
            <tr>
                <td>{{ $order->product->title }}</td>
                <td>{{$order->product->price}}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <img height="200" width="200" src="{{ asset('products/' . $order->product->image) }}" alt="gambar produk">
                </td>
            </tr>
            @endforeach
        </table>

        <!-- Logout Button -->
        
    </div>
</div>

<!-- Footer -->
@include('home.footer')
</body>
</html>
