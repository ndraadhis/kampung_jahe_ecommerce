<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title></title>
</head>
<body>
    <center>
        <h3>Nama : <?php echo e($data->name); ?></h3>
        <h3>Alamat: <?php echo e($data->rec_address); ?></h3>
        <h3>No.tlp : <?php echo e($data->phone); ?></h3>
        <h2>Nama Produk: <?php echo e($data->product->title); ?></h2>
        <h2>Harga: <?php echo e($data->product->price); ?></h2>
        <img height ="250" src="products/<?php echo e($data->product->image); ?>">
    </center>

</body>
</html><?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/invoice.blade.php ENDPATH**/ ?>