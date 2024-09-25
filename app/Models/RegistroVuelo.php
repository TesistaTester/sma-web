<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RegistroVuelo extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "registro_vuelo";
    protected $primaryKey = "rvu_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function registros_vuelo_componente(){
        return $this->hasMany(RegistroVueloComponente::class, 'rvu_id');
    }
    public function registros_vuelo_diario(){
        return $this->belongsTo(RegistroVueloDiario::class, 'rvd_id');
    }

}
