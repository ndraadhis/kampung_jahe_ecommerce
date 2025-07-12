<!DOCTYPE html>
<html>
<head> 
  @include('admin.css')

  <style type="text/css">
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    input[type='text'] {
      width: 400px;
      height: 50px;
      font-family: inherit;
    }

    .form-kanan {
      display: flex;
      justify-content: flex-end;
      margin: 30px 0;
    }

    .form-kanan form {
      display: flex;
      gap: 10px;
    }

    .form-kanan input[type="text"] {
      width: 300px;
      height: 40px;
    }

    .table_deg {
      text-align: center;
      margin: 0 auto;
      border: 2px solid yellowgreen;
      width: 600px;
      font-family: inherit;
    }

    th {
      background-color: skyblue;
      padding: 15px;
      font-size: 20px;
      font-weight: bold;
      color: white;
      font-family: inherit;
    }

    td {
      color: white;
      padding: 10px;
      border: 1px solid skyblue;
      font-family: inherit;
    }

    .btn {
      margin: 2px;
      font-family: inherit;
    }

    h1 {
      font-family: inherit;
    }
  </style>
</head>
<body>

  @include('admin.header')
  @include('admin.sidebar')

  <div class="page-content">
    <div class="page-header">
      <div class="container-fluid">
        <h1 style="color:white; text-align: center;">Tambah Kategori Produk</h1>

        <!-- Form Tambah Kategori -->
        <div class="form-kanan">
          <form action="{{ url('add_category') }}" method="POST">
            @csrf
            <input type="text" name="category" placeholder="Nama kategori..." required>
            <input class="btn btn-primary" type="submit" value="Tambah Kategori">
          </form>
        </div>

        <!-- Tabel Daftar Kategori -->
        <table class="table_deg">
          <tr>
            <th>Nama Kategori</th>
            <th>Opsi</th>
          </tr>
          @foreach($data as $data)
          <tr>
            <td>{{ $data->category_name }}</td>
            <td>
              <a class="btn btn-success" href="{{ url('edit_category', $data->id) }}">Edit</a>
              <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_category', $data->id) }}">Hapus</a>
            </td>
          </tr>
          @endforeach
        </table>

      </div>
    </div>
  </div>

  @include('admin.js')

</body>
</html>
