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
        Schema::create('registro_vuelo_componente', function (Blueprint $table) {
            $table->Increments('rvc_id');
            $table->integer('rvu_id');
            $table->integer('com_id');
            $table->text('rvc_normales')->nullable();
            $table->text('rvc_utilitarias')->nullable();
            $table->text('rvc_acrobaticas')->nullable();
            $table->text('rvc_landings')->nullable();
            $table->text('rvc_fecha')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('rvu_id')->references('rvu_id')->on('registro_vuelo');
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
        Schema::dropIfExists('registro_vuelo_componente');
    }
};
