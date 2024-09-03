<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Especialidad extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "especialidad";
    protected $primaryKey = "esp_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function funcionario(){
        return $this->hasMany(Funcionario::class, 'esp_id');
    }

}
