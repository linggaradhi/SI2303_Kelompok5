<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'keterangan',
        'updated_by',
    ];

    // Relasi: Status log milik 1 order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: Status log diupdate oleh 1 user
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
