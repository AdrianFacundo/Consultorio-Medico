<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medico;
use App\Models\Patient;
use App\Models\User;

class MedicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $usuarioMedico = User::where('tipo', 'doctor')->first(); // Buscar al usuario tipo doctor
        if ($usuarioMedico) {
            Medico::create([
                'nombre' => 'Adrian Perez',
                'telefono' => '8341209557',
                'profesion' => 'Medico General',
                'tipo' => 'Base',
                'id_usuario_medicos' => $usuarioMedico->id,
            ]);
        }

        $usuarioPaciente = User::where('tipo', 'paciente')->first(); // Buscar al usuario tipo paciente
        if ($usuarioPaciente) {
            Patient::create([
                'nombre_completo' => 'Andrea Perez',
                'fecha_nacimiento' => '2024-01-11', // Fecha de nacimiento en formato YYYY-MM-DD
                'telefono' => '8348889557',
                'genero' => 'Femenino',
            ]);
        }
    }
}