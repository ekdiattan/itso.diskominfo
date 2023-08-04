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
        Schema::create('dt_unit_kerjas', function (Blueprint $table) {
            $table->id();
            $table->string('namaUnit')->nullable();
            $table->string('aliasUnit')->nullable();
            $table->string('idUnitKerja')->nullable()->unique();
            $table->string('unitKerjaApi')->nullable();
            $table->string('unitKerjaApiLengkap')->nullable();
            $table->string('alamat')->nullable();
            $table->string('nipPimpinan')->nullable();
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
        Schema::dropIfExists('dt_unit_kerjas');
    }
};
