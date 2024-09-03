<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grado')->insert(['gra_descripcion'=> 'GENERAL DE BRIGADA AEREA', 'gra_abreviacion' => 'GRAL. BRIG. AE.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'GENERAL DE DIVISION AEREA', 'gra_abreviacion' => 'GRAL. DIV. AE.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE CORONEL AVIADOR', 'gra_abreviacion' => 'TCNL. AV.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'MAYOR AVIADOR', 'gra_abreviacion' => 'MY. AV.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'CAPITAN AVIADOR', 'gra_abreviacion' => 'CAP. AV.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE AVIADOR', 'gra_abreviacion' => 'TTE. AV.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBTENIENTE AVIADOR', 'gra_abreviacion' => 'STTE. AV.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBTENIENTE ALUMNO AVIADOR', 'gra_abreviacion' => 'STTE. A. AV.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL PRIMERO TECNICO', 'gra_abreviacion' => 'SOF. 1RO. TEC.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL SEGUNDO TECNICO', 'gra_abreviacion' => 'SOF. 2DO. TEC.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL INICIAL TECNICO', 'gra_abreviacion' => 'SOF. INC. TEC.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SARGENTO PRIMERO TECNICO', 'gra_abreviacion' => 'SGTO. 1RO. TEC.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SARGENTO SEGUNDO TECNICO', 'gra_abreviacion' => 'SGTO. 2DO. TEC.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'MAYOR DIPLOMADO EN INGENIERIA MILITAR', 'gra_abreviacion' => 'MY. DIM.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'CAPITAN DIPLOMADO EN INGENIERIA MILITAR', 'gra_abreviacion' => 'CAP. DIM.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'CAPITAN APOYO OPERATIVO', 'gra_abreviacion' => 'CAP. A.O.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE DIPLOMADO EN INGENIERIA MILITAR', 'gra_abreviacion' => 'TTE. DIM.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE APOYO OPERATIVO', 'gra_abreviacion' => 'TTE. A.O.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'GENERAL DE FUERZA AEREA', 'gra_abreviacion' => 'GRAL. FZA. AE.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBTENIENTE APOYO OPERATIVO', 'gra_abreviacion' => 'SBTTE. A.O.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL MAESTRE DIPLOMADO EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. MTRE. DESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SARGENTO INICIAL TECNICO', 'gra_abreviacion' => 'SGTO. INC. TEC.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL MAYOR DIPLOMADO EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. MY. DESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'CORONEL DIPLOMADO EN ALTOS ESTUDIOS NACIONALES', 'gra_abreviacion' => 'CNL. DAEN.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'CORONEL DIPLOMADO EN ESTADO MAYOR AEREO', 'gra_abreviacion' => 'CNL. DEMA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE CORONEL DIPLOMADO EN ALTOS ESTUDIOS NACIONALES', 'gra_abreviacion' => 'TCNL. DAEN', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE CORONEL DIPLOMADO EN ESTADO MAYOR AEREO', 'gra_abreviacion' => 'TCNL. DEMA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'TENIENTE CORONEL DIPLOMADO EN INGENIERIA MILITAR', 'gra_abreviacion' => 'TCNL. DIM.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'MAYOR DIPLOMADO EN ESTADO MAYOR AEREO', 'gra_abreviacion' => 'MY. DEMA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL SEGUNDO DIPLOMADO EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. 2DO. DESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL PRIMERO AUXILIAR EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. 1RO. AESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL PRIMERO DIPLOMADO EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. 1RO. DESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL INICIAL DIPLOMADO EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. INC. DESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
        DB::table('grado')->insert(['gra_descripcion'=> 'SUBOFICIAL MAYOR AUXILIAR EN SUPERVISION AERONAUTICA', 'gra_abreviacion' => 'SOF. MY. AESA.', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);    
        DB::table('grado')->insert(['gra_descripcion'=> 'PROFESIONAL III', 'gra_abreviacion' => 'PROF III', 'created_at'=>date('Y-m-d'), 'updated_at'=>date('Y-m-d')]);
    }
}
