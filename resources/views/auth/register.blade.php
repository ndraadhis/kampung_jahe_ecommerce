<!DOCTYPE html>
<html lang="en">
<head>
  @include('home.css')
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .register-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 90vh;
      padding: 20px;
    }

    .register-box {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 500px;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-control {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    .btn-register {
      width: 100%;
      padding: 10px;
      background-color: #1abc9c;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn-register:hover {
      background-color: #16a085;
    }

    .text-center {
      text-align: center;
    }

    .small-text {
      font-size: 14px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

@include('home.header')

<div class="register-wrapper">
  <div class="register-box">
    <h2>Daftar Akun Baru</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label for="name">Nama</label>
        <input id="name" class="form-control" type="text" name="name" required value="{{ old('name') }}">
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" class="form-control" type="email" name="email" required value="{{ old('email') }}">
      </div>

      <div class="form-group">
        <label for="phone">No. Telepon</label>
        <input id="phone" class="form-control" type="text" name="phone" required value="{{ old('phone') }}">
      </div>

      <div class="form-group">
        <label for="address">Alamat</label>
        <input id="address" class="form-control" type="text" name="address" required value="{{ old('address') }}">
      </div>

      <div class="form-group">
        <label for="password">Kata Sandi</label>
        <input id="password" class="form-control" type="password" name="password" required>
      </div>

      <div class="form-group">
        <label for="password_confirmation">Konfirmasi Kata Sandi</label>
        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
      </div>

      <button type="submit" class="btn-register">Daftar</button>

      <div class="text-center small-text">
        Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
      </div>
    </form>
  </div>
</div>

</body>
</html>
