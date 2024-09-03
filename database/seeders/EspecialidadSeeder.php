<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('especialidad')->insert(['esp_descripcion'=> 'ELECTRÓNICA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'AVIONICA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'HIDRAULICA', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'INSTRUMENTOS', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'ELECTRICIDAD', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'NAVES', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'MOTORES', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'HELICES', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'ABASTECIMIENTO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('especialidad')->insert(['esp_descripcion'=> 'PRESURIZACION', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
