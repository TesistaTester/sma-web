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
        Schema::create('unidad_funcionario', function (Blueprint $table) {
            $table->Increments('unf_id');
            $table->integer('car_id');
            $table->integer('fun_id');
            $table->date('unf_fecha_inicio');
            $table->text('unf_motivo_designacion');
            $table->date('unf_fecha_fin');
            $table->text('unf_motivo_desvinculacion');
            $table->integer('unf_activo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('car_id')->references('car_id')->on('cargo');
            $table->foreign('fun_id')->references('fun_id')->on('funcionario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unidad_funcionario');
    }
};
