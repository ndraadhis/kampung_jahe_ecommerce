<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes; // pastikan ini ditambahkan
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use SoftDeletes; // menambahkan SoftDeletes

    protected $fillable = [
        'title', 'description', 'price', 'quantity', 'category', 'image',
    ];

    // Anda juga bisa menambahkan properti berikut untuk menentukan format tanggal soft delete (jika perlu)
    protected $dates = ['deleted_at'];
}
