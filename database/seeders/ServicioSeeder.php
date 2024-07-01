<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Servicio;

class ServicioSeeder extends Seeder
{
    public function run()
    {
        // Datos a insertar en la tabla servicios
        $servicios = [
            ['Tipo' => 'Consulta General', 'precio' => 500.00],
            ['Tipo' => 'Pediatría', 'precio' => 600.00],
            ['Tipo' => 'Odontología', 'precio' => 700.00],
            ['Tipo' => 'Estudios Generales', 'precio' => 800.00],
            ['Tipo' => 'Inyección', 'precio' => 200.00],
        ];

        // Insertar datos en la tabla servicios
        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
