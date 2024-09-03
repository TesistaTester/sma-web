<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('unidad_organizacional')->insert(['uor_nombre'=> '', 'uor_superior'=> null, 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
    }
}
