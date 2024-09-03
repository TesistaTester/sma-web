<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Cargo extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "cargo";
    protected $primaryKey = "car_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function funcionarios(){
        return $this->hasMany(UnidadFuncionario::class, 'car_id');
    }
    public function unidad(){
        return $this->belongsTo(UnidadOrganizacional::class, 'uor_id');
    }

}
