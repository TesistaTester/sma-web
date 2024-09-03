<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class PersonalOrdenTrabajo extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "personal_orden_trabajo";
    protected $primaryKey = "pot_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function unidad_funcionario(){
        return $this->belongsTo(UnidadFuncionario::class, 'unf_id');
    }
    public function orden(){
        return $this->belongsTo(OrdenTrabajo::class, 'ort_id');
    }

}
