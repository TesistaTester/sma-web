<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class TarjetaCapitulo extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "tarjeta_capitulo";
    protected $primaryKey = "tac_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function tarjetas_planificadas(){
        return $this->hasMany(TarjetaPlanificada::class, 'tac_id');
    }
    public function tarjeta(){
        return $this->belongsTo(Tarjeta::class, 'tar_id');
    }

}
