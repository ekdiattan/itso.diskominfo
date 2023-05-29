<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cutis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('njab');
            $table->string('unitkerja_nama')->nullable();
            $table->string('jenis_cuti');
            $table->string('tgl_mulai');
            $table->string('tgl_selesai');
            $table->string('uraian');
            $table->string('tgl_pengajuan');
            $table->string('atasan');
            $table->string('ket_proses');
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
        Schema::dropIfExists('cutis');
    }
};
