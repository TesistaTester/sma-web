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
        Schema::create('tarjeta_planificada', function (Blueprint $table) {
            $table->Increments('tap_id');
            $table->integer('tac_id');
            $table->integer('ort_id');
            $table->integer('tap_estado');
            $table->integer('tap_tiempo_trabajo');
            $table->text('tap_descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tac_id')->references('tac_id')->on('tarjeta_capitulo');
            $table->foreign('ort_id')->references('ort_id')->on('orden_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarjeta_planificada');
    }
};
