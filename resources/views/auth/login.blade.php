<!DOCTYPE html>
<html lang="en">
<head>
  @include('home.css')
  <style>
    body {
      background-color: #f4f6f9;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 85vh;
      padding: 20px;
    }

    .login-box {
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }

    .login-box h2 {
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

    .btn-login {
      width: 100%;
      padding: 10px;
      background-color: #1abc9c;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }

    .btn-login:hover {
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

  <div class="login-wrapper">
    <div class="login-box">
      <h2>Login ke Akun</h2>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" class="form-control" type="email" name="email" required autofocus value="{{ old('email') }}">
        </div>

        <div class="form-group">
          <label for="password">Kata Sandi</label>
          <input id="password" class="form-control" type="password" name="password" required>
        </div>

        <div class="form-group">
          <label>
            <input type="checkbox" name="remember"> Ingat Saya
          </label>
        </div>

        <button type="submit" class="btn-login">Login</button>

        @if (Route::has('password.request'))
          <div class="text-center small-text">
            <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
          </div>
        @endif

        <div class="text-center small-text">
          Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
