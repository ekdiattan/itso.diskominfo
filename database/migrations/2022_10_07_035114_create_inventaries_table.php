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
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->string('merk');
            $table->string('tipe');
            $table->string('namaBarang');
            $table->string('image');
            $table->string('kondisiBarang');
            $table->string('noSertifikat')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('caraPerolehan')->nullable();
            $table->string('bulanPerolehan')->nullable();
            $table->string('tahunPerolehan')->nullable();
            $table->string('kuantitas')->nullable();
            $table->string('satuan')->nullable();
            $table->string('hargaSatuan')->nullable();
            $table->string('nilaiPerolehan')->nullable();
            $table->string('umurEkonomis')->nullable();
            $table->string('keterangan')->nullable();
            $table->boolean('status')->nullable();
            $table->string('pengguna')->nullable();
            $table->string('noHp')->nullable();
            $table->string('noBeritaAcara')->nullable();

            
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
        Schema::dropIfExists('inventaries');
    }
};
