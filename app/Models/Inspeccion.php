<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Inspeccion extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "inspeccion";
    protected $primaryKey = "ins_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function ordenes(){
        return $this->hasMany(OrdenTrabajo::class, 'ins_id');
    }
    // public function tarjetas(){
    //     return $this->hasMany(Tarjeta::class, 'ins_id');
    // }

}
