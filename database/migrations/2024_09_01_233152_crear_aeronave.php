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
        Schema::create('aeronave', function (Blueprint $table) {
            $table->Increments('ae_id');
            $table->integer('cat_id');
            $table->integer('tia_id');
            $table->integer('faa_id');
            $table->text('ae_matricula');
            $table->text('ae_serial_number');
            $table->text('ae_anio_fabricacion');
            $table->text('ae_nro_componentes');
            $table->text('ae_nro_componentes_mel');
            $table->text('ae_foto');
            $table->text('ae_estado_matricula');
            $table->text('ae_pais_adquisicion');
            $table->text('ae_tipo_adquisicion');
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
        Schema::dropIfExists('aeronave');
    }
};
