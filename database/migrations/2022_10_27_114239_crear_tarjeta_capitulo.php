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
        Schema::create('tarjeta_capitulo', function (Blueprint $table) {
            $table->Increments('tac_id');
            $table->integer('tar_id');
            $table->text('tac_titulo');
            $table->text('tac_descripcion');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('tar_id')->references('tar_id')->on('tarjeta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarjeta_capitulo');
    }
};
