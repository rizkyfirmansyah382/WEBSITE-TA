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
        Schema::create('tb_tanggal_panen', function (Blueprint $table) {
            $table->bigIncrements('id_tanggal_panen');
            $table->integer('id_superadmin');
            $table->integer('id_kelompok');
            $table->date('tgl_panen');
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
        Schema::dropIfExists('tb_tanggal_panen');
    }
};
