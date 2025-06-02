<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'tanggal_order',
        'status',
        'total_harga',
        'catatan',
    ];

    // Relasi: 1 order dimiliki oleh 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 order punya banyak sepatu
    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'order_id');
    }

    // Relasi: 1 order punya banyak status log
    public function statusLogs()
    {
        return $this->hasMany(OrderStatusLog::class);
    }
}
