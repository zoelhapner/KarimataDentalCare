<?php

namespace App\Models;

use App\Models\Tindakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dokter',
        'user_id',
        'nama_dokter',
        'role',
        'nip',
        'alamat',
        'tanggal_lahir',
        'nik',
        'nohp',
        'jadwalpraktik',
        'penghasilan', // Menambahkan kolom penghasilan  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kasirs()
    {
        return $this->hasMany(Kasir::class);
    }

    // public function tindakans()
    // {
    //     return $this->hasMany(Tindakan::class);
    // }

    public function tindakans()
    {
        return $this->hasMany(Tindakan::class, 'dokter_id', 'id_dokter'); // Sesuaikan dengan nama kolom yang benar
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id', 'id_dokter'); // Sesuaikan dengan nama kolom
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($dokter) {
            $dokter->user()->delete();
        });
    }
}
