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
        Schema::create('mapping_dashboards', function (Blueprint $table) {
            $table->id();
            $table->string('NameCard');
            $table->string('Warna');
            $table->string('nip')->nullable();
            $table->string('Name')->nullable();
            $table->string('Image')->nullable();
            $table->string('Route')->nullable();
            $table->string('Table')->nullable();
            $table->string('Kondisi')->nullable();
            $table->string('Query')->nullable();
            $table->boolean('is_checked')->default(false);
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
        Schema::dropIfExists('mapping_dashboards');
    }
};
