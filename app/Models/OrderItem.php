<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'book_id',
        'judul',
        'harga',
        'qty',
        'subtotal'
    ];

    // 🔥 RELASI: item milik order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // 🔥 RELASI: item ke buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}