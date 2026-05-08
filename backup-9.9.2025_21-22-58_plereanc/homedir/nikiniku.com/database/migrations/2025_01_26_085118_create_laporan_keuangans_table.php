<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateLaporanKeuangansTable extends Migration  
{  
    /**  
     * Run the migrations.  
     */  
    public function up(): void  
    {  
        Schema::create('laporan_keuangans', function (Blueprint $table) {  
            $table->id(); // Kolom id sebagai primary key  
            $table->foreignId('kasir_id')->constrained('kasirs')->onDelete('cascade'); // Foreign key untuk kasir  
            // $table->foreignId('dokter_id')->constrained('dokters')->onDelete('cascade'); // Foreign key untuk dokter  
            $table->decimal('total_transaksi', 10, 2); // Total transaksi  
            $table->date('tanggal'); // Tanggal laporan  
            $table->timestamps(); // Kolom created_at dan updated_at  

            // $table->foreign('dokter_id')->references('id_dokter')->on('dokters')->onDelete('cascade');
            
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     */  
    public function down(): void  
    {  
        Schema::dropIfExists('laporan_keuangans');  
    }  
}  
