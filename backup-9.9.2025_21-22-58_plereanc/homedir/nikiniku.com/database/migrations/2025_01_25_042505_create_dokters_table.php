<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
return new class extends Migration  
{  
    /**  
     * Run the migrations.  
     */  
    public function up(): void  
    {  
        Schema::create('dokters', function (Blueprint $table) {  
            $table->id('id_dokter');    
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menetapkan user_id sebagai foreign key    
            $table->string('nama_dokter')->nullable();    
            $table->string('role')->nullable();    
            $table->string('nip')->nullable();    
            $table->string('alamat')->nullable();    
            $table->date('tanggal_lahir')->nullable();    
            $table->string('nik')->nullable();    
            $table->string('nohp')->nullable();
            $table->string('jadwalpraktik')->nullable();    
            $table->decimal('penghasilan', 10, 2)->default(0); // Kolom untuk menyimpan penghasilan dokter  
            $table->timestamps();    
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     */  
    public function down(): void  
    {  
        Schema::dropIfExists('dokters');  
    }  
};  
