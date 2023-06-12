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
        Schema::create('unit_kerjas', function (Blueprint $table){
            $table->id();
            $table->string('namaUnit');
            $table->string('aliasUnit');
            $table->string('divisi');
            $table->string('divisiLengkap');
            $table->string('alamat');
            $table->string('nipPimpinan');
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
        Schema::dropIfExists('unitKerjas');
    }
};
