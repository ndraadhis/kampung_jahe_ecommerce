<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')

   <style type="text/css">
    .div_deg {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }
    label {
        display: inline-block;
        width: 200px;
        margin-bottom: 10px;
        color: white;
    }
    input[type='text'],
    input[type='number'],
    select,
    textarea {
        width: 300px;
        padding: 10px;
        margin-bottom: 20px;
    }
    textarea {
        height: 80px;
    }
    .form-box {
        background-color: #2c3e50;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.2);
        color: white;
    }
   </style>
  </head>
  <body>
   
   @include('admin.header')
   @include('admin.sidebar')

    <div class="page-content">
      <div class="page-header">
        <h2 class="text-center" style="color:white; margin-top: 20px;">Perbarui Produk</h2>

        <div class="div_deg">
          <form class="form-box" action="{{ url('/edit_product', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div>
              <label>Nama Produk</label>
              <input type="text" name="title" value="{{ $data->title }}">
            </div>

            <div>
              <label>Deskripsi Produk</label>
              <textarea name="description">{{ $data->description }}</textarea>
            </div>

            <div>
              <label>Harga</label>
              <input type="text" name="price" value="{{ $data->price }}">
            </div>

            <div>
              <label>Jumlah Produk</label>
              <input type="number" name="quantity" value="{{ $data->quantity }}">
            </div>

            <div>
              <label>Kategori</label>
              <select name="category">
                <option value="{{ $data->category }}">{{ $data->category }}</option>
                @foreach($category as $cat)
                  @if($cat->category_name !== $data->category)
                    <option value="{{ $cat->category_name }}">{{ $cat->category_name }}</option>
                  @endif
                @endforeach
              </select>
            </div>

            <div>
              <label>Gambar Saat Ini</label><br>
              <img width="150" src="{{ asset('products/'.$data->image) }}" style="margin-bottom: 20px;">
            </div>

            <div>
              <label>Perbarui Gambar Baru</label>
              <input type="file" name="image">
            </div>

            <div>
              <input class="btn btn-success" type="submit" value=" Perbarui">
            </div>

          </form>
        </div>
      </div>   
    </div>

   @include('admin.js')
  </body>
</html>
