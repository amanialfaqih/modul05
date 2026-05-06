<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // 🔥 FIELD YANG BOLEH DIISI
    protected $fillable = [
        'category_id',
        'judul',
        'penulis',
        'tahun_terbit',
        'stok',
        'harga', // ✅ TAMBAH INI (WAJIB)
        'cover'
    ];

    // 🔥 RELASI KE KATEGORI
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // 🔥 OPTIONAL (BIAR FORMAT RAPI)
    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}