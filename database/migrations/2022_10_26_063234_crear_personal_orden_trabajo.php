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
        Schema::create('personal_orden_trabajo', function (Blueprint $table) {
            $table->Increments('pot_id');
            $table->integer('unf_id');
            $table->integer('ort_id');
            $table->text('pot_tipo');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('unf_id')->references('unf_id')->on('unidad_funcionario');
            $table->foreign('ort_id')->references('ort_id')->on('orden_trabajo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_orden_trabajo');
    }
};
