<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style type="text/css">
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 50px;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font-size: 20px;
            font-weight: bold;
            background: black;
        }

        td {
            border: 1px solid skyblue;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order_deg {
            width: 400px;
        }

        .form_row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 20px;
        }

        .form_row label {
            width: 140px;
            font-weight: bold;
            margin-top: 6px;
        }

        .form_row input[type="text"],
        .form_row textarea,
        .form_row input[type="number"] {
            flex: 1;
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form_row textarea {
            resize: vertical;
            height: 80px;
        }

        .form_row input[type="submit"] {
            margin-left: 150px;
        }

        .form_left {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section starts -->
        @include('home.header')
        <!-- end header section -->
    </div>

    <div class="div_deg">
        <!-- Order Form -->
        <div class="order_deg">
            <form action="{{ url('confirm_order') }}" method="POST">
                @csrf

                <div class="form_row">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}">
                </div>

                <div class="form_row">
                    <label>Alamat</label>
                    <textarea name="address" rows="3">{{ Auth::user()->address }}</textarea>
                </div>

                <div class="form_row">
                    <label>No.tlpn</label>
                    <input type="text" name="phone" value="{{ Auth::user()->phone }}">
                </div>

                <div class="form_row">
                    <label for="nominal">Masukkan Nominal</label>
                    <input type="number" name="nominal" id="nominal" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-400" required>
                </div>

                <div class="flex space-x-2">
                    <button type="submit" name="payment_method" value="cash on delivery" class="btn btn-secondary px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">
                        Cash On Delivery
                    </button>
                    <button type="submit" name="payment_method" value="transfer" class="btn btn-primary px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Bayar
                    </button>
                </div>
            </form>
        </div>

        <!-- Cart Table -->
        <table>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Hapus</th>
            </tr>
            <?php
             $value = 0; 
             ?>
            @foreach($cart as $cart)
            <tr>
                <td>{{ $cart->product->title }}</td>
                <td>{{ $cart->product->price }}</td>
                <td>
                    <img width="150" src="/products/{{ $cart->product->image }}">
                </td>
                <td>
                    <a class="btn btn-danger" href="{{ url('delete_cart', $cart->id) }}">Hapus</a>
                </td>
            </tr>
            <?php 
               $value = $value + $cart->product->price;
             ?>

            @endforeach
        </table>
    </div>

    <div class="cart_value">
    <h3>Total Harga : Rp.{{ $value }}</h3>

    </div>

    <!-- footer section -->
    @include('home.footer')
</body>

</html>