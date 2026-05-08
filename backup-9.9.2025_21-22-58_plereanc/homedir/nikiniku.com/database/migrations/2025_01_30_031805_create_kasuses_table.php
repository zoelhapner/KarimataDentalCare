<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tindakan_id')->constrained('tindakans')->onDelete('cascade'); // Menambahkan foreign key ke tabel tindakan
            $table->string('kasus');
            $table->string('diagnosa');
            $table->string('tindakan_khusus');
            $table->decimal('biaya', 10, 2);
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
        Schema::dropIfExists('kasuses');
    }
}
