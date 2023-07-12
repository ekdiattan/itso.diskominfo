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
        Schema::create('tmp_dt_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string("nip")->unique()->nullable();
            $table->string("user_id")->unique();
            $table->string("email")->nullable();
            $table->string("fullname")->nullable();
            $table->string("birth_place")->nullable();
            $table->string("birth_date")->nullable();
            $table->string("marital_status")->nullable();
            $table->string("religion")->nullable();
            $table->string("blood_type")->nullable();
            $table->string("gender")->nullable();
            $table->string("age")->nullable();
            $table->string("telephone")->nullable();
            $table->string("id_divisi")->nullable();
            $table->string("divisi")->nullable();
            $table->string("id_jabatan")->nullable();
            $table->string("jabatan")->nullable();
            $table->boolean("is_staff")->default(false);
            $table->string("join_date")->nullable();
            $table->boolean('is_active')->default(true);
            $table->string("resign_date")->nullable();
            $table->string("reason_resignation")->nullable();
            $table->string("id_card_address")->nullable();
            $table->string("current_address")->nullable();
            $table->string("bank_account_number")->nullable();
            $table->string("bank_account_name")->nullable();
            $table->string("bank_branch")->nullable();
            $table->string("npwp")->nullable();
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
        Schema::dropIfExists('tmp_dt_pegawais');
    }
};
