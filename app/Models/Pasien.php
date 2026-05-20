<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';

    protected $fillable = [
        'nama_pasien',
        'jenis_kelamin',
        'alamat_pasien',
        'profesi',
        'nik',
        'nohp',
        'alergi',
        'province_id',
        'city_id',
        'district_id',
        'sub_district_id',
        'postal_code_id', 
    ];

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
}
