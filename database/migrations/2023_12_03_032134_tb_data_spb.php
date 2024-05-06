<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_data_spb', function (Blueprint $table) {
            $table->bigIncrements('id_data_spb');
            $table->integer('id_kelompok');
            $table->integer('id_tanggal_panen');
            $table->integer('id_superadmin');
            $table->integer('id_sopir');
            $table->integer('id_blok');
            $table->integer('id_kendaraan');
            $table->float('total_janjang');
            $table->string('tujuan_pks');
            $table->string('no_spb');
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
        Schema::dropIfExists('tb_data_spb');
    }
};
