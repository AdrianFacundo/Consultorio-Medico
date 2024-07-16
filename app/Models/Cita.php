<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paciente_citas',
        'id_servicio_citas',
        'fecha',
        'peso',
        'estatura',
        'temperatura',
        'frecuencia_cardiaca',
        'tension',
        'oxigeno',
        'motivo_consulta',
        'id_producto_citas',
        'cantidad',
        'frecuencia',
        'duracion',
        'nota'
    ];

    public function paciente()
    {
        return $this->belongsTo(Patient::class, 'id_paciente_citas');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio_citas');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto_citas');
    }
}
