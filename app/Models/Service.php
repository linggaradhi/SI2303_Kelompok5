<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'nama',
        'harga',
        'keterangan',
    ];

    public function shoes()
    {
        return $this->hasMany(Shoe::class, 'service_id');
    }
}
