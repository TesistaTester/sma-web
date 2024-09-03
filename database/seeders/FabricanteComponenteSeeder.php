<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FabricanteComponenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'LYCOMING ENGINE','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'HARTZELL PROPELLER INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'NIAGARA THERMAL PRODUCTS LLC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'WELDON PUMP LLC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'JIHOSTROJ A S','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'LAMAR TECHNOLOGIES LLC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'ZLIN AIRCRAFT A S','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'CHARVAT   AXL A S','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'CONCORDE BATTERY CORPORATION','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'WHELEN ENGINEERING COMPANY INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'MESIT AEROSPACE S R O','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'MIKROTECHNA  PRAHA A S','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'MIDCONTINENT AIRCRAFT CORPORATION','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'LETECKE PRISTROJE  PRAHA S R O ','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'GARMIN','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'AIRCRAFT INDUSTRIES A S','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'SPEEL PRAHA S R O','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'EDMO DISTRIBUTORS INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'ALCOR INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'COMANT INDUSTRIES INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'AVIALL SERVICES INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'ESTO CHEB S R O ','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'BENDIX','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'CHAMPION AEROSPACE','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'SKY TEC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'AVSTAR AVIATION ACCESSORIES','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('fabricante_componente')->insert(['fac_nombre'=> 'ACR ELECTRONICS INC','fac_descripcion'=> '', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
