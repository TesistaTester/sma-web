<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoAereoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO DE ENTRENAMIENTO 21','gru_direccion'=> 'CAMINO A NUEVA CANAAN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO DE CAZA 31','gru_direccion'=> 'AVENIDA JUAN PABLO SEGUNDO SN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 71','gru_direccion'=> 'AVENIDA JUAN PABLO SEGUNDO SN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO PRESIDENCIAL','gru_direccion'=> 'AVENIDA JUAN PABLO SEGUNDO SN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 65','gru_direccion'=> 'AVENIDA FUERZA AEREA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 66','gru_direccion'=> 'AVENIDA VILLARROEL', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 34','gru_direccion'=> 'AVENIDA FUERZA AEREA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 51','gru_direccion'=> 'AVENIDA DEL CABILDO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 22','gru_direccion'=> 'CAMINO A LA NUEVA CANAAN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 61','gru_direccion'=> 'AVENIDA AEROPUERTO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 83','gru_direccion'=> 'AVENIDA CAPITAN DE AVIACION SALVADOR OGAYA G.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 63','gru_direccion'=> 'AVENIDA AEROPUERTO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 62','gru_direccion'=> 'AVENIDA BERNARDINO OCHOA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 72','gru_direccion'=> 'CAMINO TRINIDAD LOMA SUAREZ', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grupo_aereo')->insert(['gru_nombre'=> 'GRUPO AEREO 64','gru_direccion'=> 'AVENIDA OSCAR ESCALANTE', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
