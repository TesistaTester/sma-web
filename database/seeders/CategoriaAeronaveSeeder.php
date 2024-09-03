<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaAeronaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria_aeronave')->insert(['cae_nombre'=> 'ACROBATICO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('categoria_aeronave')->insert(['cae_nombre'=> 'NORMAL', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('categoria_aeronave')->insert(['cae_nombre'=> 'UTILITARIO', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
