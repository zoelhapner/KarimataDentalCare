<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $fillable = [
        'tindakan_id', 
        'kasus',
        'diagnosa',
        'tindakan_khusus',
        'biaya'
    ];

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }
}
