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
        Schema::create('tb_anggota_tervalidasi', function (Blueprint $table) {
            $table->bigIncrements('id_anggota_tervalidasi');
            $table->integer('id_superadmin');
            $table->integer('id_kelompok');
            $table->integer('id_blok');
            $table->string('photo');
            $table->string('nama_anggota');
            $table->string('luas_lahan');
            $table->string('nik');
            $table->date('tgl_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('pekerjaan');
            $table->string('alamat_tinggal');
            $table->date('tgl_masuk_anggota');
            $table->string('no_anggota');
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
        Schema::dropIfExists('tb_anggota_tervalidasi');
    }
};
