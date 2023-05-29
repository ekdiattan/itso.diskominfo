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
        Schema::create('asets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('merk')->nullable();
            $table->string('jenis');
            $table->string('jumlah')->default('0');
            $table->string('kapasitas');
            // untuk kendaraan
            $table->string('kodeUnit')->nullable()->unique();
            $table->string('tahun')->nullable();
            $table->string('rangka')->nullable()->unique();
            $table->string('mesin')->nullable()->unique();
            $table->string('kebersihan')->nullable();
            $table->string('bahanBakar')->nullable();
            $table->string('keterangan')->nullable();
            // end untuk kendaraan
            $table->string('status')->default('tersedia');
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
        Schema::dropIfExists('asets');
    }
};
