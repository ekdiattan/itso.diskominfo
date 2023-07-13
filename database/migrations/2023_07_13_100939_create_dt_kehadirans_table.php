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
        Schema::create('dt_kehadirans', function (Blueprint $table) {
            $table->id();
            $table->string("_id")->unique()->nullable();
            $table->string("startDate")->nullable();
            $table->string("endDate")->nullable();
            $table->string("officeHours")->nullable();
            $table->string("location")->nullable();
            $table->string("message")->nullable();
            $table->string("note")->nullable();
            $table->string("mood")->nullable();
            $table->string("fullname")->nullable();
            $table->string("email")->nullable();
            $table->string("username")->nullable();
            $table->string("divisi")->nullable();
            $table->string("jabatan")->nullable();
            $table->string("date");
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
        Schema::dropIfExists('dt_kehadirans');
    }
};
