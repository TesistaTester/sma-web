<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Funcionario extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "funcionario";
    protected $primaryKey = "fun_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function unidades(){
        return $this->hasMany(UnidadFuncionario::class, 'fun_id');
    }

    public function persona(){
        return $this->belongsTo(Persona::class, 'per_id');
    }
    public function grado(){
        return $this->belongsTo(Grado::class, 'gra_id');
    }
    public function especialidad(){
        return $this->belongsTo(Especialidad::class, 'esp_id');
    }
}
