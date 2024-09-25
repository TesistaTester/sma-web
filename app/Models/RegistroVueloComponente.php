<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class RegistroVueloComponente extends Model
{
    use HasFactory;
    
    use LogsActivity;

    protected $table = "registro_vuelo_componente";
    protected $primaryKey = "rvc_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function registro_vuelo(){
        return $this->belongsTo(RegistroVuelo::class, 'rvu_id');
    }
    public function componente(){
        return $this->belongsTo(Componente::class, 'com_id');
    }

}
