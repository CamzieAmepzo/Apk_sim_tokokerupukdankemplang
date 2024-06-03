<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrafPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('draf_pendaftaran', function (Blueprint $table) {
            $table->bigIncrements('id_draf');
            $table->bigInteger('id_kategori');
            $table->string('nama_barang', '100');
            $table->bigInteger('jenisbarang')->nullable();
            $table->bigInteger('bayar')->nullable();
            $table->date('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('draf_pendaftaran');
    }
}
