<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat',
        'merk',
        'ukuran',
        'harga_beli',
        'tanggal_beli',
        'supplier',
    ];

}
