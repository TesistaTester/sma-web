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
        Schema::create('detalle_grupo_aeronave', function (Blueprint $table) {
            $table->Increments('dga_id');
            $table->integer('gru_id')->nullable();
            $table->integer('ae_id')->nullable();
            $table->date('dga_fecha_cambio');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('gru_id')->references('gru_id')->on('grupo_aereo');
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
        Schema::dropIfExists('detalle_grupo_aeronave');
    }
};
