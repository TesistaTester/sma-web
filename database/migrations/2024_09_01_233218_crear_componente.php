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
        Schema::create('componente', function (Blueprint $table) {
            $table->Increments('com_id');
            $table->integer('fac_id')->nullable();
            $table->text('com_serial_number')->nullable();
            $table->text('com_part_number')->nullable();
            $table->text('com_descripcion')->nullable();
            $table->text('com_modelo')->nullable();
            $table->integer('com_tipo_componente')->nullable();
            $table->integer('com_master')->nullable();
            $table->integer('com_principal')->nullable();
            $table->text('com_hv_ac_normales')->nullable();
            $table->text('com_hv_ac_acrobaticas')->nullable();
            $table->text('com_hv_ac_utilitarias')->nullable();
            $table->text('com_hv_ac_landings')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('fac_id')->references('fac_id')->on('fabricante_componente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('componente');
    }
};
