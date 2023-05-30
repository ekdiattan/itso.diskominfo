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
        Schema::create('dt_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string("user_id")->unique();
            $table->string("email");
            $table->string("fullname");
            $table->string("username");
            $table->string("birth_date");
            $table->string("id_divisi");
            $table->string("divisi");
            $table->string("id_jabatan");
            $table->string("jabatan");
            $table->string("is_admin");
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('dt_pegawais');
    }
};
