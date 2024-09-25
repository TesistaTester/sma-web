<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RegistroVueloDiario extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "registro_vuelo_diario";
    protected $primaryKey = "rvd_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function registros_vuelo(){
        return $this->hasMany(RegistroVuelo::class, 'rvd_id');
    }
    
    public function aeronave(){
        return $this->belongsTo(Aeronave::class, 'ae_id');
    }

}
