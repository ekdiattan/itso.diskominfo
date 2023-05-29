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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aset_id');
            $table->string('namaPemohon');
            $table->string('nip');
            $table->string('noTelp');
            $table->string('bidang');
            $table->string('tiket')->unique();
            $table->string('mulai');
            $table->string('selesai');
            $table->enum('keperluan', ['Dinas', 'Pribadi'])->nullable();
            $table->string('perihal');
            $table->string('suratPermohonan')->nullable();
            $table->string('tanggalPermohonan');
            $table->string('kebersihan')->nullable();
            $table->string('bahanBakar')->nullable();
            $table->string('penanggungJawab')->nullable();
            $table->string('pengambilKunci')->nullable();
            $table->string('nama_email')->nullable();
            $table->string('keterangan')->nullable();
            $table->enum('status', ['Dalam Pengajuan', 'Disetujui', 'Ditolak','Dipinjam','Selesai'])->default('Dalam Pengajuan');
            $table->string('penyetuju')->nullable();
            $table->string('waktu')->nullable();
            $table->string('alasan')->nullable();
            $table->string('hostname')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
