<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class UnidadOrganizacional extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "unidad_organizacional";
    protected $primaryKey = "uor_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function cargos(){
        return $this->hasMany(Cargo::class, 'uor_id');
    }

}
