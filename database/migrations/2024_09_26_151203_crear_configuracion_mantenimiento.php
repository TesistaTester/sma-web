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
        Schema::create('configuracion_mantenimiento', function (Blueprint $table) {
            $table->Increments('cma_id');
            $table->integer('com_id');
            $table->text('cma_nombre_tipo_inspeccion')->nullable();
            $table->boolean('cma_horas_control')->nullable();
            $table->integer('cma_horas_frecuencia')->nullable();
            $table->integer('cma_horas_cota_max')->nullable();
            $table->boolean('cma_unica_vez')->nullable();
            $table->boolean('cma_especial')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('com_id')->references('com_id')->on('componente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracion_mantenimiento');
    }
};
