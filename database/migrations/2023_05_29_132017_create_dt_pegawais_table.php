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
            /* 
                +"id": "edb41e68-4a5c-4f56-9cb2-0b5fd82d0c59"
                +"email": "ade.jqr@gmail.com"
                +"fullname": "Ade Fayzal Hidayat"
                +"username": "ade.jqr"
                +"first_name": "Ade Fayzal"
                +"last_name": "Hidayat"
                +"birth_place": "Sukabumi"
                +"birth_date": "1991-08-26"
                +"marital_status": "Belum Menikah"
                +"religion": null
                +"blood_type": null
                +"gender": "Pria"
                +"age": 31
                +"telephone": "08"
                +"is_staff": false
                +"id_divisi": "e9b8a3fe-a35c-441d-9e93-9a6c8c33c84a"
                +"divisi": "JQR"
                +"id_jabatan": "977ce6fd-6b3d-4703-9cb5-3df64cc34283"
                +"jabatan": "Tenaga Teknis Operasional"
                +"photo": "#"
                +"manager_category": "Tenaga Teknis"
                +"join_date": "2022-04-01T00:04:00+07:00"
                +"is_active": false
                +"resign_date": "2023-03-01T00:03:00+07:00"
                +"npwp": null
                +"reason_resignation": null
                +"id_card_address": null
                +"current_address": null
                +"account_bank": null
            */
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
