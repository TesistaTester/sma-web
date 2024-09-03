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
        Schema::create('registro_vuelo_diario', function (Blueprint $table) {
            $table->Increments('rvd_id');
            $table->integer('ae_id');
            $table->text('rvd_fecha')->nullable();
            $table->text('rvd_digitalizado')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('ae_id')->references('ae_id')->on('aeronave');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_vuelo_diario');
    }
};
