<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class LaporanKeuangan extends Model  
{  
    use HasFactory;  
  
    protected $fillable = [  
        'kasir_id',  
        'dokter_id',  
        'total_transaksi',  
        'tanggal',  
    ];  
  
    public function kasir()  
    {  
        return $this->belongsTo(Kasir::class);  
    }  
  
    public function dokter()  
    {  
        return $this->belongsTo(Dokter::class);  
    }  
            public function getTanggalVisitFormattedAttribute()
    {
        return $this->tanggal_visit ? Carbon::parse($this->tanggal_visit)->format('d/m/Y') : '-';
    }
}  
