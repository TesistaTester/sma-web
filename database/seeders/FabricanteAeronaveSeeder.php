<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricanteAeronaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'CESSNA','faa_descripcion'=> 'CESSNA AIRCRAFT COMPANY FABRICANTE DE AVIONES QUE VAN DE PEQUENOS MODELOS DE 4 PLAZAS HASTA REACTORES DE NEGOCIOS', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'AIRBUS','faa_descripcion'=> 'EMPRESA EUROPEA QUE DISENA FABRICA Y VENDE AVIONES CIVILES', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'BEECHCRAFT','faa_descripcion'=> 'BEECH AIRCRAFT CORPORATION FABRICANTE DE AVIONES DE AVION GENERAL Y AVION MILITAR', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'BOEING','faa_descripcion'=> 'BOEING COMPANY ES UNA EMPRESA MULTINACIONAL ESTADOUNIDENSE', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'ANTONOV','faa_descripcion'=> 'COMPANIA RUSA QUE FABRICA AERONAVES DE TRANSPORTE MULTI PROPOSITO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'BRITISH AEROSPACE','faa_descripcion'=> 'EMPRESA AERONAUTICA Y DE DEFENSA BRITANICA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'LOCKHEED MARTIN','faa_descripcion'=> 'LOCKHEED MARTIN ES UNA COMPAÑIA MULTINACIONAL DE ORIGEN ESTADOUNIDENSE DE LA INDUSTRIA AEROESPACIAL', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_aeronave')->insert(['faa_nombre'=> 'ZLIN','faa_descripcion'=> 'COMPANIA DE AVIONES CHECA ACTUALMENTE PRODUCE EN SERIE LA FAMILIA DE AVIONES ZLIN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
