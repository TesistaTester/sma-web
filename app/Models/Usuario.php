<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Usuario extends Authenticatable
{
    use HasFactory;
    use LogsActivity;

    protected $table = "usuario";
    protected $primaryKey = "usu_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function funcionario(){
        return $this->belongsTo(Funcionario::class, 'fun_id');
    }
    public function rol(){
        return $this->belongsTo(Rol::class, 'rol_id');
    }

}
