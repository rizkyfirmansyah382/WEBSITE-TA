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
        Schema::create('tb_kendaraan', function (Blueprint $table) {
            $table->bigIncrements('id_kendaraan');
            $table->integer('id_superadmin');
            $table->string('no_polisi');
            $table->string('jenis_kendaraan');
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
        Schema::dropIfExists('tb_kendaraan');
    }
};
