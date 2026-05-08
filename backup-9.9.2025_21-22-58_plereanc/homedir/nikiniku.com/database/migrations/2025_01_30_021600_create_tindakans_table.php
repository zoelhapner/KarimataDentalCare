<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dokter_id'); // Foreign key ke tabel dokters
            // $table->unsignedBigInteger('nama_dokter');
            $table->unsignedBigInteger('pasien_id'); // Foreign key ke tabel pasien (jika ada)
            $table->date('tanggal_visit');
            $table->time('jam');
            $table->string('tindakan');
            $table->text('pemakaian_obat')->nullable();
            $table->text('tindak_lanjut')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('dokter_id')->references('id_dokter')->on('dokters')->onDelete('cascade');
            $table->foreign('pasien_id')->references('id_pasien')->on('pasiens')->onDelete('cascade'); // Opsional
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tindakans', function (Blueprint $table) {
            $table->dropForeign(['dokter_id']);
            $table->dropForeign(['nama_dokter']);
            $table->dropForeign(['pasien_id']); // Opsional
        });

        Schema::dropIfExists('tindakans');
    }
}
