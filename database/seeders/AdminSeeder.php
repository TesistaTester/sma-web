<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //usuario: admin password: 
        DB::table('usuario')->insert(['rol_id'=> 1, 'usu_nombre'=> 'admin', 'password'=> '$2a$10$Dr9wAUvus4nanbHtVKREf.hrBR41K5NTPkhVzLMhb.Qc3npvMQYsC','usu_email'=> 'jsonspartan@gmail.com','created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
