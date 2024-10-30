<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class ServicioComponente extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "servicio_componente";
    protected $primaryKey = "sec_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function componente(){
        return $this->belongsTo(Componente::class, 'com_id');
    }

}
