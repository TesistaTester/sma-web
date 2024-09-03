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
        Schema::create('inventario_aeronave', function (Blueprint $table) {
            $table->Increments('ina_id');
            $table->integer('com_id');
            $table->integer('ae_id');
            $table->text('ina_ubicacion')->nullable();
            $table->boolean('ina_componente_mel')->nullable();
            $table->text('ina_descripcion_mel')->nullable();
            $table->date('ina_fecha_instalacion')->nullable();
            $table->text('ina_ci_responsable_instalacion')->nullable();
            $table->text('ina_observaciones_instalacion')->nullable();
            $table->date('ina_fecha_remocion')->nullable();
            $table->text('ina_ci_responsable_remocion')->nullable();
            $table->text('ina_observaciones_remocion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('com_id')->references('com_id')->on('componente');
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
        Schema::dropIfExists('inventario_aeronave');
    }
};
