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
        Schema::create('pulangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip');
            $table->string('nama');
            $table->string('unitkerja_nama')->nullable();
            $table->string('pulang')->nullable();
            $table->string('tanggal')->nullable()->unique();
            $table->string('update')->nullable()->unique();
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
        Schema::dropIfExists('pulangs');
    }
};
