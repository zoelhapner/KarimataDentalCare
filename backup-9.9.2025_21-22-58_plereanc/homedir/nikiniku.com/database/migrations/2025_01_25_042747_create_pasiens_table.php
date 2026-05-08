<?php

use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreatePasiensTable extends Migration  
{  
    /**  
     * Run the migrations.  
     */  
    public function up(): void  
    {  
        Schema::create('pasiens', function (Blueprint $table) {  
            $table->id('id_pasien');  
            $table->string('nama_pasien'); 
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('alamat_pasien'); 
            $table->string('profesi')->nullable();
            $table->string('nik');  
            $table->string('nohp');  
            $table->text('alergi')->nullable();
            $table->timestamps(); 
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     */  
    public function down(): void  
    {  
        Schema::dropIfExists('pasiens');  
    }  
};
