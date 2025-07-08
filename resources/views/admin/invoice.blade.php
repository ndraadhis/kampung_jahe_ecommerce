<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title></title>
</head>
<body>
    <center>
        <h3>Nama : {{$data->name}}</h3>
        <h3>Alamat: {{$data->rec_address}}</h3>
        <h3>No.tlp : {{$data->phone}}</h3>
        <h2>Nama Produk: {{$data->product->title}}</h2>
        <h2>Harga: {{$data->product->price}}</h2>
        <img height ="250" src="products/{{$data->product->image}}">
    </center>

</body>
</html>