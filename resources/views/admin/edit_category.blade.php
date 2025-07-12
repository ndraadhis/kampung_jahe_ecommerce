<!DOCTYPE html>
<html>
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

    form {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      justify-content: center;
    }

    input[type='text'] {
      width: 400px;
      height: 50px;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .btn-primary {
      height: 50px;
      font-size: 16px;
      padding: 0 25px;
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

        <h1>Perbarui Kategori Produk</h1>

        <div class="div_deg">
          <form action="{{ url('update_category', $data->id) }}" method="POST">
            @csrf
            <input type="text" name="category" value="{{ $data->category_name }}" required>
            <input class="btn btn-primary" type="submit" value="Perbarui Kategori">
          </form>
        </div>

      </div>   
    </div>
  </div>

  @include('admin.js')
</body>
</html>
