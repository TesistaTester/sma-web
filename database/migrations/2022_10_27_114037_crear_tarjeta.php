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
        Schema::create('tarjeta', function (Blueprint $table) {
            $table->Increments('tar_id');
            $table->integer('ins_id')->nullable();
            $table->text('tar_numero');
            $table->text('tar_descripcion');
            $table->text('tar_ata');
            $table->text('tar_especialidad');
            $table->text('tar_tecnicas_inspeccion');
            $table->text('tar_digitalizado');
            $table->timestamps();
            $table->softDeletes();
            // $table->foreign('ins_id')->references('ins_id')->on('inspeccion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarjeta');
    }
};
