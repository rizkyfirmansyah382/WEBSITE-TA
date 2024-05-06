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
        Schema::create('tb_data_anggota_lama', function (Blueprint $table) {
            $table->bigIncrements('id_data_anggota_lama');
            $table->integer('id_anggota_lama');
            $table->integer('id_anggota_tervalidasi');
            $table->integer('id_kelompok');
            $table->string('photo');
            $table->string('nama_anggota_lama');
            $table->string('nik');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->string('no_anggota');
            $table->date('tanggal_lahir');
            $table->date('tanggal_keluar');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
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
        Schema::dropIfExists('tb_data_anggota_baru');
    }
};
