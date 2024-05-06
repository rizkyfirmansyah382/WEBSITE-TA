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
        Schema::create('tb_daftar_anggota_baru', function (Blueprint $table) {
            $table->bigIncrements('id_daftar_anggota_baru');
            $table->integer('id_kelompok');
            $table->integer('id_anggota_tervalidasi');
            $table->string('KkPdf');
            $table->string('SertifPdf');
            $table->string('JBPdf');
            $table->string('nama_anggota_baru');
            $table->string('nik');
            $table->string('alamat');
            $table->string('pekerjaan');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('status', ['Proses Verifikasi', 'Selesai Verifikasi']);
            $table->date('tanggal_lahir');
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
        Schema::dropIfExists('tb_daftar_anggota_baru');
    }
};
