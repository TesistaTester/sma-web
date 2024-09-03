<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rol')->insert(['rol_nombre'=> 'ADMINISTRADOR', 'rol_codigo'=> 1 ,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_nombre'=> 'COMANDANTE', 'rol_codigo'=> 2 ,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('rol')->insert(['rol_nombre'=> 'CONTROL DE CALIDAD', 'rol_codigo'=> 3 ,'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
