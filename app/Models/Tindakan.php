<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Tindakan extends Model
{
    protected $fillable = [
        'dokter_id', // Pastikan ini ada
        'pasien_id', // Pastikan ini ada
        'tanggal_visit',
        'jam',
        'tindakan',
        'pemakaian_obat',
        'tindak_lanjut',
    ];

    public function kasus()
    {
        return $this->hasMany(Kasus::class);
    }

    public function kasir()
    {
        return $this->hasOne(Kasir::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id_dokter');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'pasien_id', 'id_pasien');
    }
        public function getBirthDateFormattedAttribute()
    {
        return $this->tanggal_visit ? Carbon::parse($this->tanggal_visit)->format('d/m/Y') : '-';
    }
}