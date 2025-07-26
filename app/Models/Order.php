<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Tambahkan ini agar mass assignment tidak error
    protected $fillable = [
        'transaction_code',
        'name',
        'rec_address',
        'phone',
        'user_id',
        'product_id',
        'payment_status',
        'status',
        'resi',
        'shipping_provider',
        'shipping_cost',
        'bukti_transfer',
        'bank_tujuan',
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    // Jika pakai invoice semua item satu transaksi (opsional)
    public function orderItems()
    {
        return $this->hasMany(Order::class, 'transaction_code', 'transaction_code');
    }
}
