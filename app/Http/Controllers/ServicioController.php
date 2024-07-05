<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{
    public function create()
    {
        $servicios = Servicio::all();
        return view('doctor.servicios', compact('servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        Servicio::create([
            'tipo' => $request->tipo,
            'precio' => $request->precio,
        ]);

        return redirect()->route('servicios.create')->with('success', 'Servicio registrado exitosamente.');
    }

    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        if ($servicio) {
            $servicio->delete();
            return redirect()->route('servicios.create')->with('success', 'Servicio eliminado exitosamente.');
        }
        return redirect()->route('servicios.create')->with('error', 'Servicio no encontrado.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
            'precio' => 'required|numeric',
        ]);

        $servicio = Servicio::find($id);
        if ($servicio) {
            $servicio->tipo = $request->tipo;
            $servicio->precio = $request->precio;
            $servicio->save();

            return redirect()->route('servicios.create')->with('success', 'Servicio actualizado exitosamente.');
        }

        return redirect()->route('servicios.create')->with('error', 'Servicio no encontrado.');
    }
}
