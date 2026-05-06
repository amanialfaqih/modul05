<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'metode_pembayaran',
        'status'
    ];

    // RELASI: order punya banyak item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // RELASI: order milik user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}