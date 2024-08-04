<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>  
</head>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <span>{{ __("Tabla de consultas") }}</span>
                    <div class="flex space-x-4">
                </div>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Paciente
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Servicio
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Fecha de atencion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Motivo de consulta
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Medicacion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estado de pago
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Descargar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($citas as $cita)
                            @php
                                $paciente = $pacientes->find($cita->id_paciente_citas);
                                $servicio = $servicios->find($cita->id_servicio_citas);
                                $producto = $productos->find($cita->id_producto_citas);
                            @endphp
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $paciente->nombre_completo }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $servicio->Tipo }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $cita->fecha }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $cita->motivo_consulta }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $producto->producto }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap 
                                    {{ $cita->estado == 'Pagado' ? 'text-green-500' : ($cita->estado == 'No pagado' ? 'text-red-500' : '') }}">
                                    {{ $cita->estado }}
                                </th>
                                <td class="px-6 py-4">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-1 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>