<?php  
  
namespace App\Models;  
  
use Illuminate\Database\Eloquent\Factories\HasFactory;  
use Illuminate\Database\Eloquent\Model;  
  
class Manajer extends Model  
{  
    use HasFactory;      
      
    protected $fillable = [    
        'user_id',  
        'nama_manajer',  
        'role',  
        'nip',  
        'alamat',  
        'tanggal_lahir',  
        'nik',  
        'nohp'  
    ];    
    
    public function user()      
    {      
        return $this->belongsTo(User::class);      
    }      
}  
