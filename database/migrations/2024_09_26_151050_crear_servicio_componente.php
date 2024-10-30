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
        Schema::create('servicio_componente', function (Blueprint $table) {
            $table->Increments('sec_id');
            $table->integer('com_id');
            $table->date('sec_fecha_ultimo_overhaul')->nullable();
            $table->date('sec_fecha_primera_instalacion')->nullable();
            $table->boolean('sec_horas_normales_control')->nullable();
            $table->integer('sec_horas_normales_tope')->nullable();
            $table->integer('sec_horas_normales_acumulado')->nullable();
            $table->boolean('sec_horas_acrobaticas_control')->nullable();
            $table->integer('sec_horas_acrobaticas_tope')->nullable();
            $table->integer('sec_horas_acrobaticas_acumulado')->nullable();
            $table->boolean('sec_horas_utilitarias_control')->nullable();
            $table->integer('sec_horas_utilitarias_tope')->nullable();
            $table->integer('sec_horas_utilitarias_acumulado')->nullable();
            $table->boolean('sec_landings_control')->nullable();
            $table->integer('sec_landings_tope')->nullable();
            $table->integer('sec_landings_acumulado')->nullable();
            $table->boolean('sec_dias_control')->nullable();
            $table->integer('sec_dias_tope')->nullable();
            $table->integer('sec_dias_acumulado')->nullable();
            $table->boolean('sec_fecha_vencimiento_control')->nullable();
            $table->date('sec_fecha_vencimiento_tope')->nullable();
            $table->integer('sec_fecha_vencimiento_acumulado')->nullable();
            $table->boolean('sec_activo')->default(true);
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
        Schema::dropIfExists('servicio_componente');
    }
};
