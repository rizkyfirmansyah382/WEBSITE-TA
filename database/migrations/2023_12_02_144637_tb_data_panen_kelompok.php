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
        Schema::create('tb_data_panen_kelompok', function (Blueprint $table) {
            $table->bigIncrements('id_data_panen_kelompok');
            $table->integer('id_superadmin');
            $table->integer('id_tanggal_panen');
            $table->integer('id_anggota_tervalidasi');
            $table->float('tonase_anggota');
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
        Schema::dropIfExists('tb_data_panen_kelompok');
    }
};
