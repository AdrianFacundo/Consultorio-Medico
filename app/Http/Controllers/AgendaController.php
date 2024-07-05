<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Patient;
use App\Models\Servicio;

class AgendaController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('secretaria.pacientes', compact('pacientes','servicios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('doctor.pacientes', compact('pacientes','servicios'));
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_paciente_agenda' => 'required',
            'id_servicio_agenda' => 'required', // Validar el servicio
            'fecha' => 'required|date',
            'hora' => 'required',
            'telefono' => 'required',
        ]);

        Agenda::create([
            'id_paciente_agenda' => $request->id_paciente_agenda,
            'id_servicio_agenda' => $request->id_servicio_agenda, // Guardar el servicio
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'telefono' => $request->telefono,
            'atendida' => false,
        ]);

        return redirect()->route('agendas.create')->with('success', 'Cita agendada correctamente');
    }

    public function atendida($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->atendida = 1;
        $agenda->save();

        return redirect()->route('dashboard')->with('success', 'Cita marcada como atendida.');
    }
}
