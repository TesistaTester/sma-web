<?php

namespace App\Models;

use Database\Seeders\FabricanteComponenteSeeder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Componente extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "componente";
    protected $primaryKey = "com_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function fabricante(){
        return $this->belongsTo(FabricanteComponente::class, 'rvu_id');
    }

    public function registros_vuelo(){
        return $this->hasMany(RegistroVueloComponente::class, 'com_id');
    }

    public function configuraciones_mantenimiento(){
        return $this->hasMany(ConfiguracionMantenimiento::class, 'com_id');
    }

    public function servicios(){
        return $this->hasMany(ServicioComponente::class, 'com_id');
    }

}
