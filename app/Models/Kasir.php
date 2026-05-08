<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $fillable = [
        'tindakan_id',
        'total_biaya',
        'dibayar',
        'kembalian',
        'metode_pembayaran',
    ];

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }
}
