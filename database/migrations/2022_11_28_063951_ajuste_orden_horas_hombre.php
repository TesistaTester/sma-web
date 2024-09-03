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
        Schema::table('orden_trabajo', function (Blueprint $table) {
            $table->integer('ort_horas_hombre_total')->default(0);//Entero en minutos
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orden_trabajo', function (Blueprint $table) {
            $table->dropColumn('ort_horas_hombre_total');
        });
    }
};
