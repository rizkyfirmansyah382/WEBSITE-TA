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
        Schema::create('tb_input_hasil_pks', function (Blueprint $table) {
            $table->bigIncrements('id_input_hasil_pks');
            $table->integer('id_superadmin');
            $table->integer('id_data_spb');
            $table->integer('bruto');
            $table->integer('tarra');
            $table->integer('netto_terima');
            $table->integer('sortasi');
            $table->integer('netto_bersih');
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
        Schema::dropIfExists('tb_input_hasil_pks');
    }
};
