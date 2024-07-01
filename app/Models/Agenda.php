<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_paciente_agenda',
        'id_servicio_agenda',
        'fecha',
        'hora',
        'telefono',
        'atendida',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_paciente_agenda');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio_agenda');
    }
}
