<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UnidadFuncionario extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "unidad_funcionario";
    protected $primaryKey = "fun_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function asignaciones(){
        return $this->hasMany(PersonalOrdenTrabajo::class, 'unf_id');
    }
    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'fun_id');
    }
    public function cargo(){
        return $this->belongsTo(Cargo::class, 'car_id');
    }

}
