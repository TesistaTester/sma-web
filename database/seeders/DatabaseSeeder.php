<?php

namespace Database\Seeders;

use App\Models\GrupoAereo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EspecialidadSeeder::class,
            GradoSeeder::class,
            RolSeeder::class,
            AdminSeeder::class,
            GrupoAereoSeeder::class,
            CategoriaAeronaveSeeder::class,
            TipoAeronaveSeeder::class,
            FabricanteAeronaveSeeder::class,
            FabricanteComponenteSeeder::class,
        ]);
    }
}
