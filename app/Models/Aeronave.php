<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Aeronave extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "aeronave";
    protected $primaryKey = "ae_id";

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}

    public function detalles(){
        return $this->hasMany(DetalleGrupoAeronave::class, 'ae_id');
    }
    public function horas_diario(){
        return $this->hasMany(RegistroVueloDiario::class, 'ae_id');
    }
    public function inventarios(){
        return $this->hasMany(InventarioAeronave::class, 'ae_id');
    }

    public function tipo(){
        return $this->belongsTo(TipoAeronave::class, 'tia_id');
    }
    public function categoria(){
        return $this->belongsTo(CategoriaAeronave::class, 'cae_id');
    }
    public function fabricante(){
        return $this->belongsTo(FabricanteAeronave::class, 'faa_id');
    }


}
