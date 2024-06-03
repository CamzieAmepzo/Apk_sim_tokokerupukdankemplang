<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datatransaksi', function (Blueprint $table) {
            $table->bigIncrements('id_datatransaksi');
            $table->bigInteger('id_barang');
            $table->bigInteger('nominal');
            $table->string('keterangan', '50');
            $table->string('status', '50');
            $table->date('tanggal');
            $table->time('waktu');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datatransaksi');
    }
}
