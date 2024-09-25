<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class GrupoAereo extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "grupo_aereo";
    protected $primaryKey = "gru_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function detalles(){
        return $this->hasMany(DetalleGrupoAeronave::class, 'gru_id');
    }

    public function unidades(){
        return $this->hasMany(UnidadOrganizacional::class, 'gru_id');
    }

}
