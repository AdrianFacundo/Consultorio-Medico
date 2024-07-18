<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Servicio;
use App\Models\Patient;
use App\Models\User;
use App\Models\Producto;
use App\Models\Cita;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function dashboard()
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
        } elseif (auth()->user()->tipo === 'paciente') {
            $agendas = Agenda::all();
            $pacientes = Patient::all();
            return view('paciente.dashboard', compact('agendas', 'pacientes'));
        }
    }

    public function pacientes()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('secretaria.pacientes', compact('pacientes', 'servicios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            $pacientes = Patient::all();
            $servicios = Servicio::all();
            return view('doctor.pacientes', compact('pacientes', 'servicios'));
        }
    }

    public function productos()
    {
        if (auth()->user()->tipo === 'secretaria') {
            return view('secretaria.productos');
        } elseif (auth()->user()->tipo === 'doctor') {
            $productos = Producto::all();
            return view('doctor.productos', compact('productos'));
        }
    }

    public function usuarios()
    {
        if (auth()->user()->tipo === 'secretaria') {
            $usuarios = User::all();
            return view('secretaria.usuarios', compact('usuarios'));
        } elseif (auth()->user()->tipo === 'doctor') {
            return view('doctor.usuarios');
        }
    }

    public function consultas()
    {
        $citas = Cita::all();
        $pacientes = Patient::all();
        $servicios = Servicio::all();
        $productos = Producto::all();
        return view('doctor.listaConsulta', compact('citas','pacientes','servicios','productos'));
    }

    public function servicios()
    {
        $servicios = Servicio::all();
        return view('doctor.servicios', compact('servicios'));
    }

    public function calendario()
    {
        $events = [];
        
        if (auth()->user()->tipo === 'paciente') {
            $agendas = Agenda::with(['patient'])->where('atendida', 0)->get();
            
            foreach ($agendas as $agenda) {
                $events[] = [
                    'title' => 'Ocupado',
                    'start' => $agenda->fecha . 'T' . $agenda->hora,
                    'end' => $agenda->fecha . 'T' . date('H:i:s', strtotime($agenda->hora) + 3600), // Asumiendo que cada cita dura 1 hora
                ];
            }
            return view('paciente.calendario', compact('events'));
        } else {
            $agendas = Agenda::with(['patient', 'servicio'])->where('atendida', 0)->get();

            foreach ($agendas as $agenda) {
                $events[] = [
                    'title' => $agenda->patient->nombre_completo,
                    'start' => $agenda->fecha . 'T' . $agenda->hora,
                    'end' => $agenda->fecha . 'T' . date('H:i:s', strtotime($agenda->hora) + 3600), // Asumiendo que cada cita dura 1 hora
                ];
            }

            return view('doctor.calendario', compact('events'));
        }
    }


}
