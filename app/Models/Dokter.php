<?php

namespace App\Models;

use App\Models\Tindakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Dokter extends Model
{
    use HasFactory;

    protected $fillable = [
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

    protected $primaryKey = 'id_dokter';

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
        public function getBirthDateFormattedAttribute()
    {
        return $this->tanggal_lahir ? Carbon::parse($this->tanggal_lahir)->format('d/m/Y') : '-';
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($dokter) {
            $dokter->user()->delete();
        });
    }
}
