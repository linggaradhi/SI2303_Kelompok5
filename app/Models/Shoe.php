<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    protected $fillable = [
        'order_id',
        'merk',
        'warna',
        'tipe',
        'kondisi',
        'service_id',
        'foto'
    ];

    // Relasi: Sepatu milik 1 order
    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
