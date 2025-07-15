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

    .hidden {
      display: none;
    }

    .bank_notice {
      background-color: #fff3cd;
      color: #856404;
      padding: 10px 15px;
      border: 1px solid #ffeeba;
      border-radius: 6px;
      margin-top: -10px;
      margin-bottom: 20px;
      display: none;
    }
  </style>
</head>

<body>
  @include('home.header')

  <div class="confirm_container">
    <h2>Konfirmasi Pesanan</h2>

    <form method="POST" action="{{ url('/confirm_order') }}">
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

      <div class="form_group hidden" id="bank_options">
        <label>Pilih Bank</label>
        <select name="bank_name" id="bank_name">
          <option value="">-- Pilih Bank --</option>
          <option value="BRI">Bank BRI</option>
          <option value="BCA">Bank BCA</option>
          <option value="SeaBank">SeaBank</option>
          <option value="Mandiri">Bank Mandiri</option>
        </select>
      </div>

      <div class="bank_notice" id="bank_notice"></div>

      <button type="submit" class="submit_btn">Proses Pesanan</button>
    </form>
  </div>

  @include('home.footer')

  <script>
    const paymentMethod = document.getElementById('payment_method');
    const bankOptions = document.getElementById('bank_options');
    const bankNotice = document.getElementById('bank_notice');
    const bankSelect = document.getElementById('bank_name');

    const rekeningInfo = {
      BRI: {
        bank: 'Bank BRI',
        norek: '1354 5432 3456',
        nama: 'Indra Adhi Saputra'
      },
      BCA: {
        bank: 'Bank BCA',
        norek: '4456 3678 2345',
        nama: 'Kampung Jahe'
      },
      SeaBank: {
        bank: 'SeaBank',
        norek: '9013 3263 0480',
        nama: 'Indra Adhi Saputra'
      },
      Mandiri: {
        bank: 'Bank Mandiri',
        norek: '9784 6578 1432',
        nama: 'Kampung Jahe'
      }
    };

    paymentMethod.addEventListener('change', function () {
      if (this.value === 'transfer') {
        bankOptions.classList.remove('hidden');
        bankNotice.style.display = 'block';
      } else {
        bankOptions.classList.add('hidden');
        bankNotice.style.display = 'none';
        bankNotice.innerHTML = '';
      }
    });

    bankSelect.addEventListener('change', function () {
      const selectedBank = this.value;
      if (rekeningInfo[selectedBank]) {
        const info = rekeningInfo[selectedBank];
        bankNotice.innerHTML = `
          Silakan transfer ke rekening berikut:<br>
          <strong>${info.bank}</strong><br>
          No. Rekening: <strong>${info.norek}</strong><br>
          a.n. <strong>${info.nama}</strong>
        `;
        bankNotice.style.display = 'block';
      } else {
        bankNotice.style.display = 'none';
        bankNotice.innerHTML = '';
      }
    });
  </script>
</body>

</html>
