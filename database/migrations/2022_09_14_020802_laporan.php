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
        Schema::create('laporans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tiket')->unique();
            $table->string('nippencatat');
            $table->string('namapencatat');
            $table->string('tanggalmencatat');
            $table->string('namapelapor');
            $table->string('namabidang');
            $table->string('nomorhp'); // pelapor
            $table->string('permasalahan');
            $table->string('nipeksekutor')->nullable();
            $table->string('namaeksekutor')->nullable();
            $table->string('kategori')->nullable(); // kategori permasalahan, bisa jaringan ataupun yang lainnya
            $table->string('status')->nullable();
            $table->string('tanggalselesai')->nullable(); // ketika masalah sudah ditandai sebagai terselesaikan
            $table->string('solusi')->nullable();
            $table->string('namavendor')->nullable();
            $table->string('mulaiservice')->nullable();
            $table->string('selesaiservice')->nullable();
            $table->boolean('isDone')->default(false);
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
        Schema::dropIfExists('laporans');
    }
};
