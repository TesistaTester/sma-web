<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Tarjeta extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = "tarjeta";
    protected $primaryKey = "tar_id";

    public function tarjetas_capitulo(){
        return $this->hasMany(TarjetaCapitulo::class, 'tar_id');
    }
    // public function inspeccion(){
    //     return $this->belongsTo(Inspeccion::class, 'ins_id');
    // }

    //logs auditoria para todos los valores de cada tabla
    public function getActivitylogOptions(): LogOptions{return LogOptions::defaults()->logOnly(['*']);}


}
