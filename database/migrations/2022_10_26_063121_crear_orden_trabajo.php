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
        Schema::create('orden_trabajo', function (Blueprint $table) {
            $table->Increments('ort_id');
            $table->integer('ort_id_rel')->nullable();
            $table->integer('ins_id')->nullable();
            $table->text('ort_matricula')->nullable();
            $table->text('ort_serial_number_aeronave')->nullable();
            $table->text('ort_tiempo_total_aeronave')->nullable();
            $table->text('ort_ciclos_total_aeronave')->nullable();
            $table->text('ort_serial_number_componente')->nullable();
            $table->text('ort_tiempo_total_componente')->nullable();
            $table->text('ort_ciclos_total_componente')->nullable();
            $table->text('ort_descripcion_trabajo')->nullable();
            $table->text('ort_lugar')->nullable();
            $table->text('ort_fecha')->nullable();
            $table->text('ort_gestion')->nullable();
            $table->text('ort_nro')->nullable();
            $table->text('ort_cite')->nullable();
            $table->text('ort_fecha_inicio')->nullable();
            $table->text('ort_fecha_termino')->nullable();
            $table->text('ort_trabajo_efectuado')->nullable();
            $table->text('ort_iaw')->nullable();
            $table->text('ort_documento_ruta')->nullable();
            $table->integer('ort_tipo')->nullable();
            $table->float('ort_avance')->nullable();
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
        Schema::dropIfExists('orden_trabajo');
    }
};
