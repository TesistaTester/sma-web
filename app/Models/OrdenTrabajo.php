<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class OrdenTrabajo extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "orden_trabajo";
    protected $primaryKey = "ort_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function tarjetas_planificadas(){
        return $this->hasMany(TarjetaPlanificada::class, 'ort_id');
    }
    public function personal(){
        return $this->hasMany(PersonalOrdenTrabajo::class, 'ort_id');
    }
    public function inspeccion(){
        return $this->belongsTo(Inspeccion::class, 'ins_id');
    }
    public function tarjeta(){
        return $this->belongsTo(Tarjeta::class, 'tar_id');
    }

}

