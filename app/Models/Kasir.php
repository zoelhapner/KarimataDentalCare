<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        public function getTanggalVisitFormattedAttribute()
    {
        return $this->tanggal_visit ? Carbon::parse($this->tanggal_visit)->format('d/m/Y') : '-';
    }
}
