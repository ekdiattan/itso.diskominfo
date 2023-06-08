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
        Schema::create('dt_pendidikans', function (Blueprint $table) {
            $table->id();
            $table->string('pendidikan_id')->nullable();
            $table->string('account')->nullable();
            $table->string('name_educational_institution')->nullable();
            $table->string('education_degree')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('graduation_year')->nullable();
            $table->string('majors')->nullable();
            $table->string('file_diploma')->nullable();
            $table->string('file_grade_transcript')->nullable();
            $table->timestamps();
            /* 
                +"id": "8ecd429a-e479-4e9e-86cc-0515cd34240d"
                +"account": "eccf97f8-3cef-423d-9064-676721768a8a"
                +"name_educational_institution": "UPI"
                +"education_degree": "S.Pd."
                +"educational_level": "S1"
                +"graduation_year": 2017
                +"majors": "Pendidikan"
                +"file_diploma": null
                +"file_grade_transcript": null
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
        Schema::dropIfExists('dt_pendidikans');
    }
};
