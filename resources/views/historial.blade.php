<!DOCTYPE html>
<html>
<head>
    <title>Historial Médico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f9;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .cita {
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
            padding-bottom: 20px;
        }
        .cita h2 {
            margin-top: 0;
        }
        .paid {
            color: green;
        }
        .unpaid {
            color: red;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header p {
            margin: 0;
            color: #555;
        }
        .header .details {
            margin-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Historial Médico</h1>
            <p>Dr. Adrian Perez</p>
            <p>Universidad Politécnica de Victoria</p>
            <div class="details">
                <p><strong>Paciente:</strong> {{ $paciente->nombre_completo }}</p>
                <p><strong>Fecha de Nacimiento:</strong> {{ $paciente->fecha_nacimiento }}</p>
            </div>
        </div>
        @forelse($citas as $cita)
            <div class="cita">
                <h2>Cita del {{ $cita->fecha }}</h2>
                <table>
                    <tr>
                        <th>Peso</th>
                        <th>Estatura</th>
                        <th>Temperatura</th>
                        <th>Frecuencia Cardiaca</th>
                        <th>Tensión</th>
                        <th>Oxígeno</th>
                    </tr>
                    <tr>
                        <td>{{ $cita->peso }} kg</td>
                        <td>{{ $cita->estatura }} m</td>
                        <td>{{ $cita->temperatura }} °C</td>
                        <td>{{ $cita->frecuencia_cardiaca }} bpm</td>
                        <td>{{ $cita->tension }} mm/Hg</td>
                        <td>{{ $cita->oxigeno }} %</td>
                    </tr>
                </table>
                <p><strong>Motivo de Consulta:</strong> {{ $cita->motivo_consulta }}</p>
                <p><strong>Medicación:</strong> {{ $cita->producto->producto }}</p>
                <p><strong>Cantidad:</strong> {{ $cita->cantidad }}</p>
                <p><strong>Servicios:</strong> {{ $cita->servicio->Tipo }}</p>
                <p><strong>Nota:</strong> {{ $cita->nota }}</p>
                <p class="{{ $cita->estado == 'Pagado' ? 'paid' : 'unpaid' }}">
                    <strong>Estado de Pago:</strong> {{ $cita->estado }}
                </p>
                <p><strong>Total:</strong> ${{ $cita->total }}</p>
            </div>
        @empty
            <p>Sin consultas previas.</p>
        @endforelse
    </div>
</body>
</html>
