<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class CategoriaAeronave extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "categoria_aeronave";
    protected $primaryKey = "cae_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function aeronaves(){
        return $this->hasMany(Aeronave::class, 'cae_id');
    }

}
