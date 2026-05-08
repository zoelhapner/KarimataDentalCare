<?php
/* 
use Illuminate\Database\Migrations\Migration;  
use Illuminate\Database\Schema\Blueprint;  
use Illuminate\Support\Facades\Schema;   */
  
/* class CreateKasirsTable extends Migration  
{  
 
    public function up(): void  
    {  
        Schema::create('kasirs', function (Blueprint $table) {  
            $table->id(); // Kolom id_transaksi sebagai primary key  
            $table->foreignId('tindakan_id')->constrained()->onDelete('cascade'); // Foreign key untuk tindakan  
            $table->foreignId('obat_id')->constrained()->onDelete('cascade'); // Foreign key untuk obat  
            $table->string('nama_pasien'); // Nama pasien  
            $table->string('nama_dokter'); // Nama dokter  
            $table->string('kasus'); // Kasus  
            $table->integer('harga'); // Harga  
            $table->integer('biaya_admin'); // Biaya admin  
            // Total tidak disimpan, bisa dihitung saat dibutuhkan  
            $table->timestamps(); // Kolom created_at dan updated_at  
        });  
    }  
  
   
    public function down(): void  
    {  
        Schema::dropIfExists('kasirs');  
    }  
};  */





use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasirs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tindakan_id')->constrained()->onDelete('cascade'); // Relasi ke Tindakan
            $table->decimal('total_biaya', 15, 2); // Total biaya dari semua kasus
            $table->decimal('dibayar', 15, 2)->default(0); // Jumlah yang dibayar pasien
            $table->decimal('kembalian', 15, 2)->default(0); // Kembalian (dibayar - total_biaya)
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasirs');
    }
}

