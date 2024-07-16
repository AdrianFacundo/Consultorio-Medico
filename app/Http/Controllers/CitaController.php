<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medico;
use App\Models\Servicio;
use App\Models\Producto;
use App\Models\Cita;
use App\Models\Agenda;

class CitaController extends Controller
{
    public function create()
    {
        $agendas = Agenda::all();
        $pacientes = Patient::all();
        $servicios = Servicio::all();
        $productos = Producto::all();
        return view('doctor.dashboard', compact('agendas', 'pacientes', 'servicios', 'productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente_citas' => 'required|exists:pacientes,id',
            'id_servicio_citas' => 'required|exists:servicios,id',
            'fecha' => 'required|date',
            'peso' => 'required|numeric',
            'estatura' => 'required|numeric',
            'temperatura' => 'required|numeric',
            'frecuencia_cardiaca' => 'required|numeric',
            'tension' => 'required|string',
            'oxigeno' => 'required|numeric',
            'motivo_consulta' => 'required|string',
            'id_producto_citas' => 'required|exists:productos,id',
            'cantidad' => 'required|integer',
            'frecuencia' => 'required|string',
            'duracion' => 'required|string',
            'nota' => 'required|string',
        ]);

        // Crear cita
        $cita = Cita::create([
            'id_paciente_citas' => $request->id_paciente_citas,
            'id_servicio_citas' => $request->id_servicio_citas,
            'fecha' => $request->fecha,
            'peso' => $request->peso,
            'estatura' => $request->estatura,
            'temperatura' => $request->temperatura,
            'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
            'tension' => $request->tension,
            'oxigeno' => $request->oxigeno,
            'motivo_consulta' => $request->motivo_consulta,
            'id_producto_citas' => $request->id_producto_citas,
            'cantidad' => $request->cantidad,
            'frecuencia' => $request->frecuencia,
            'duracion' => $request->duracion,
            'nota' => $request->nota,
        ]);

        $agenda = Agenda::findOrFail($request->id_agenda);
        $agenda->atendida = 1;
        $agenda->save();

        return redirect()->route('citas.create')->with('success', 'Consulta concluida exitosamente.');
    }

}
