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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->unique();
            $table->string('username');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('nama_bidang');
            $table->string('no_hp');
            $table->string('hak_akses');
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('users');
    }
};
Schema::table('users', function (Blueprint $table) {
    $table->string('new_password')->nullable();
});
