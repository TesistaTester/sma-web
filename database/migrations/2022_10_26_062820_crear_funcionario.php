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
        Schema::create('funcionario', function (Blueprint $table) {
            $table->Increments('fun_id');
            $table->integer('per_id');
            $table->integer('gra_id');
            $table->integer('esp_id');
            $table->text('fun_nivel');
            $table->text('fun_pid');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('per_id')->references('per_id')->on('persona');
            $table->foreign('esp_id')->references('esp_id')->on('especialidad');
            $table->foreign('gra_id')->references('gra_id')->on('grado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario');
    }
};
