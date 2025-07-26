<!DOCTYPE html>
<html>
<head>
  @include('home.css')
  <style>
    .confirm_container {
      max-width: 700px;
      margin: 50px auto;
      background: #f4f4f4;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    .confirm_container h2 {
      text-align: center;
      margin-bottom: 25px;
    }

    .form_group {
      margin-bottom: 20px;
    }

    .form_group label {
      font-weight: bold;
      display: block;
      margin-bottom: 8px;
    }

    .form_group input,
    .form_group textarea,
    .form_group select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 14px;
    }

    .form_group textarea {
      resize: vertical;
    }

    .submit_btn {
      background-color: #28a745;
      color: white;
      padding: 12px;
      width: 100%;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }

    .submit_btn:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  @include('home.header')

  <div class="confirm_container">
    <h2>Konfirmasi Pesanan</h2>

    <form method="POST" action="{{ url('/confirm_order') }}" enctype="multipart/form-data">
      @csrf

      <div class="form_group">
        <label>Nama Lengkap</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" required>
      </div>

      <div class="form_group">
        <label>Alamat Lengkap</label>
        <textarea name="address" required>{{ Auth::user()->address }}</textarea>
      </div>

      <div class="form_group">
        <label>No. Telepon</label>
        <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>
      </div>

      <div class="form_group">
        <label>Metode Pembayaran</label>
        <select name="payment_method" id="payment_method" required>
          <option value="">-- Pilih Metode --</option>
          <option value="cash on delivery">Cash on Delivery</option>
          <option value="transfer">Transfer Bank</option>
        </select>
      </div>

      <div class="form_group">
        <label>Jasa Ekspedisi</label>
        <select name="shipping_provider" required>
          <option value="">-- Pilih Ekspedisi --</option>
          <option value="JNE">JNE</option>
          <option value="J&T">J&T</option>
          <option value="SiCepat">SiCepat</option>
          <option value="Pos Indonesia">Pos Indonesia</option>
          <option value="AnterAja">AnterAja</option>
          <option value="GrabExpress">GrabExpress</option>
          <option value="GoSend">GoSend</option>
        </select>
      </div>

      <button type="submit" class="submit_btn">Proses Pesanan</button>
    </form>
  </div>

  @include('home.footer')
</body>
</html>
