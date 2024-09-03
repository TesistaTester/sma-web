<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Persona extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "persona";
    protected $primaryKey = "per_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function funcionario(){
        return $this->hasOne(Funcionario::class, 'per_id');
    }

}
