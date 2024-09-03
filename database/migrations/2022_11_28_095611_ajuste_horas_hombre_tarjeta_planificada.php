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
        Schema::table('tarjeta_planificada', function (Blueprint $table) {
            $table->integer('tap_horas_hombre')->default(0);//Entero en minutos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tarjeta_planificada', function (Blueprint $table) {
            $table->dropColumn('tap_horas_hombre');
        });
    }
};
