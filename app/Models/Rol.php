<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Rol extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "rol";
    protected $primaryKey = "rol_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function usuarios(){
        return $this->hasMany(Usuario::class, 'rol_id');
    }

}
