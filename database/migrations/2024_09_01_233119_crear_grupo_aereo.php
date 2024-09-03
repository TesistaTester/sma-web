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
        Schema::create('grupo_aereo', function (Blueprint $table) {
            $table->Increments('gru_id');
            $table->text('gru_nombre');
            $table->text('gru_direccion')->nullable();
            $table->text('gru_telefono')->nullable();
            $table->text('gru_foto')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupo_aereo');
    }
};
