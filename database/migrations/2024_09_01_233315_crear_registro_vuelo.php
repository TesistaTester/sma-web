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
        Schema::create('registro_vuelo', function (Blueprint $table) {
            $table->Increments('rvu_id');
            $table->integer('rvd_id');
            $table->text('rvu_normales')->nullable();
            $table->text('rvu_utilitarias')->nullable();
            $table->text('rvu_acrobaticas')->nullable();
            $table->text('rvu_landings')->nullable();
            $table->text('rvu_fecha')->nullable();
            $table->text('rvu_observacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rvd_id')->references('rvd_id')->on('registro_vuelo_diario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro_vuelo');
    }
};
