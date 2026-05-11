<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nama_pasien',
        'jenis_kelamin',
        'alamat_pasien',
        'profesi',
        'nik',
        'nohp',
        'alergi',
    ];
}
