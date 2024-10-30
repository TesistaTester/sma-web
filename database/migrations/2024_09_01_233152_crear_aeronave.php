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
        Schema::create('aeronave', function (Blueprint $table) {
            $table->Increments('ae_id');
            $table->integer('cae_id');
            $table->integer('tia_id');
            $table->integer('faa_id');
            $table->text('ae_matricula')->nullable();
            $table->text('ae_serial_number')->nullable();
            $table->text('ae_anio_fabricacion')->nullable();
            $table->text('ae_nro_componentes')->nullable();
            $table->text('ae_nro_componentes_mel')->nullable();
            $table->text('ae_foto')->nullable();
            $table->text('ae_estado_matricula')->nullable();
            $table->text('ae_pais_adquisicion')->nullable();
            $table->text('ae_tipo_adquisicion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cae_id')->references('cae_id')->on('categoria_aeronave');
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
        Schema::dropIfExists('aeronave');
    }
};
