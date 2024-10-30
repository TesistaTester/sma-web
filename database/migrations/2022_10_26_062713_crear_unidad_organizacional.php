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
        Schema::create('unidad_organizacional', function (Blueprint $table) {
            $table->Increments('uor_id');
            $table->integer('uor_superior');
            $table->integer('gru_id')->nullable();
            $table->text('uor_nombre');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cat_id')->references('cat_id')->on('categoria_aeronave');
            $table->foreign('tia_id')->references('tia_id')->on('tipo_aeronave');
            $table->foreign('faa_id')->references('faa_id')->on('fabricante_aeronave');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_organizacional');
    }
};
