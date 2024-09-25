<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class FabricanteComponente extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "fabricante_componente";
    protected $primaryKey = "fac_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function componentes(){
        return $this->hasMany(Componente::class, 'fac_id');
    }

}
