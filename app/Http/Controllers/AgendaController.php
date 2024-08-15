<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Patient;
use App\Models\Servicio;
use App\Models\Producto;
use App\Models\Cita;

class AgendaController extends Controller
{
    public function create()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $agendas = Agenda::all();
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('secretaria.dashboard', compact('agendas', 'pacientes', 'servicios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $agendas = Agenda::all();
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('doctor.dashboard', compact('agendas', 'pacientes', 'servicios'));
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

    // Validar si ya existe una cita en la misma fecha y hora
    $existingAppointment = Agenda::where('fecha', $request->fecha)
                                 ->where('hora', $request->hora)
                                 ->first();

    if ($existingAppointment) {
        return redirect()->route('agendas.create')->withErrors(['hora' => 'Ya existe una cita reservada para esa fecha y hora.']);
    }

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


    public function show($id)
    {
        $agenda = Agenda::findOrFail($id);
        $paciente = Patient::findOrFail($agenda->id_paciente_agenda);
        $servicio = Servicio::findOrFail($agenda->id_servicio_agenda);
        $productos = Producto::all();
        $citas = Cita::where('id_paciente_citas', $agenda->id_paciente_agenda)->get();
        return view('doctor.consulta', compact('agenda', 'paciente', 'servicio','productos','citas'));
    }


    public function desatendida($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->atendida = 0;
        $agenda->save();

        return redirect()->route('dashboard')->with('success', 'Cita marcada como desatendida.');
    }

    public function getAvailableHours(Request $request)
{
    $fecha = $request->query('fecha');

    // Obtener todas las horas ocupadas en la fecha especificada
    $occupiedHours = Agenda::where('fecha', $fecha)->pluck('hora')->toArray();

    // Horas posibles (8:00 a 15:00)
    $allHours = [];
    for ($i = 8; $i <= 15; $i++) {
        $allHours[] = $i . ':00';
    }

    // Filtrar horas disponibles
    $availableHours = array_diff($allHours, $occupiedHours);

    return response()->json(['availableHours' => $availableHours]);
}
}
