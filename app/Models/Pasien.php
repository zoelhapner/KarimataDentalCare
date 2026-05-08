<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasiens';
    protected $primaryKey = 'id_pasien';

    // Menonaktifkan incrementing jika primary key bukan integer
    public $incrementing = false;

    // Jenis primary key
    protected $keyType = 'string';

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'id_pasien',
        'nama_pasien',
        'jenis_kelamin',
        'alamat_pasien',
        'profesi',
        'nik',
        'nohp',
        'alergi',
    ];
}
