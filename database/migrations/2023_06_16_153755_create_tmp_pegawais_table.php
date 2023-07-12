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
        Schema::create('tmp_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempatLahir')->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->string('noPegawai')->unique();
            $table->string('unitKerja_id')->nullable();
            $table->string('unitKerja')->nullable();
            $table->string('golonganPangkat')->nullable();
            $table->date('tmtGolongan')->nullable();
            $table->string('eselon')->nullable();
            $table->string('namaJabatan')->nullable();
            $table->date('tmtJabatan')->nullable();
            $table->string('statusPegawai')->nullable();
            $table->date('tmtPegawai')->nullable();
            $table->integer('masaKerjaTahun')->nullable();
            $table->integer('masaKerjaBulan')->nullable();
            $table->string('jenisKelamin')->nullable();
            $table->string('agama')->nullable();
            $table->string('perkawinan')->nullable();
            $table->string('pendidikanAwal')->nullable();
            $table->string('jurusanPendidikanAwal')->nullable();
            $table->string('pendidikanAkhir')->nullable();
            $table->string('jurusanPendidikanAkhir')->nullable();
            $table->string('kategoriPendidikan')->nullable();
            $table->string('noAkses')->nullable();
            $table->string('noNpwp')->nullable();
            $table->string('nik')->nullable();
            $table->string('alamatRumah')->nullable();
            $table->string('telp')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('kedudukanPegawai')->nullable();
            $table->string('tglGabung')->nullable();
            $table->string('tglPisah')->nullable();
            $table->string('reasonPisah')->nullable();
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
        Schema::dropIfExists('tmp_pegawais');
    }
};
