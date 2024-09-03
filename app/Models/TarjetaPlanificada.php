<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TarjetaPlanificada extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "tarjeta_planificada";
    protected $primaryKey = "tap_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}
    
    public function tarjeta_capitulo(){
        return $this->belongsTo(TarjetaCapitulo::class, 'tac_id');
    }
    public function orden(){
        return $this->belongsTo(OrdenTrabajo::class, 'ort_id');
    }

}
