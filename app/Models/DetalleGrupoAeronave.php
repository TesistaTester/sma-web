<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class DetalleGrupoAeronave extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "detalle_grupo_aeronave";
    protected $primaryKey = "dga_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function grupo(){
        return $this->belongsTo(GrupoAereo::class, 'gru_id');
    }
    public function aeronave(){
        return $this->belongsTo(Aeronave::class, 'ae_id');
    }
    
}
