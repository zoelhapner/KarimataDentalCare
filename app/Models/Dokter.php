<?php

namespace App\Models;

use App\Models\Tindakan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;

class Dokter extends Model
{
    use HasFactory;
    protected $casts = [
        'jadwalpraktikbaru' => 'array',
    ];
    protected $fillable = [
        'user_id',
        'nama_dokter',
        'role',
        'nip',
        'alamat',
        'tanggal_lahir',
        'nik',
        'nohp',
        'jadwalpraktikbaru',
        'penghasilan',
        'province_id',
        'city_id',
        'district_id',
        'sub_district_id',
        'postal_code_id', 
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

    public function province() {
        return $this->belongsTo(Province::class);
    }

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function subDistrict() {
        return $this->belongsTo(SubDistrict::class);
    }

    public function postalCode() {
        return $this->belongsTo(PostalCode::class);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($dokter) {
            $dokter->user()->delete();
        });
    }
}
