<?php  
  
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;  
  
class CreateObatsTable extends Migration  
{  
    /**  
     * Run the migrations.  
     */  
    public function up(): void  
    {  
        Schema::create('obats', function (Blueprint $table) {  
            $table->id('id_obat'); // Kolom id sebagai primary key  
            $table->string('nama_obat'); // Nama obat  
            $table->string('merk'); // Merk obat  
            $table->string('ukuran'); // Ukuran obat  
            $table->decimal('harga_beli', 10, 2); // Harga beli obat  
            $table->date('tanggal_beli'); // Tanggal beli obat  
            $table->string('supplier'); // Supplier obat  
        
            $table->timestamps(); // Kolom created_at dan updated_at  
        });  
    }  
  
    /**  
     * Reverse the migrations.  
     */  
    public function down(): void  
    {  
        Schema::dropIfExists('obats');  
    }  
}  
