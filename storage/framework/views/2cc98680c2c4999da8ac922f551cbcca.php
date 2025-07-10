<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('admin.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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

    <?php echo $__env->make('admin.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 class="text-center">Tambah Produk</h1>

                <div class="div_deg">
                    <form action="<?php echo e(url('upload_product')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

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
                                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <?php echo $__env->make('admin.js', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH E:\Kampung_Jahe_Ecommerce\resources\views/admin/add_product.blade.php ENDPATH**/ ?>