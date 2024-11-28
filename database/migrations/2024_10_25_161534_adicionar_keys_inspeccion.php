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
        Schema::table('inspeccion', function (Blueprint $table) {
            $table->integer('cma_id')->nullable();
            $table->integer('sec_id')->nullable(); 
            $table->integer('ins_hora_componente')->nullable()->default(0); 
            $table->integer('ins_hora_componente_max')->nullable()->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inspeccion', function (Blueprint $table) {
            $table->dropColumn('cma_id');
            $table->dropColumn('sec_id');
            $table->dropColumn('ins_hora_componente');
            $table->dropColumn('ins_hora_componente_max');
        });
    }
};
