<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <span>{{ __("Tabla de consultas") }}</span>
                    <div class="flex space-x-4">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Descargar Historial
                        </button>
                    </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($citas as $cita)
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
                            </tr>
                        @empty
                            <tr class="bg-gray-100 border border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <td colspan="7" class="px-6 py-4 text-center text-gray-700 dark:text-gray-300 font-semibold">
                                    Sin consultas previas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Main modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Descargar Historial de Paciente
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form id="delete-patient-form" method="GET" action="{{ route('citas.pdf') }}" class="p-4 md:p-5">
                    @csrf
                    <!-- Nombre del Paciente -->
                    <div class="mt-4">
                        <x-input-label for="paciente_id" :value="__('Nombre del Paciente')" />
                        <select id="paciente_id" name="paciente_id" class="block mt-1 w-full">
                            <option value="">Seleccione un paciente</option>
                            @php
                                $pacientes_unicos = $citas->unique('id_paciente_citas');
                            @endphp
                            @foreach($pacientes_unicos as $cita)
                                @php
                                    $paciente = $pacientes->find($cita->id_paciente_citas);
                                @endphp
                                <option value="{{ $paciente->id }}">{{ $paciente->nombre_completo }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('paciente_id')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v14a1 1 0 001 1h8a1 1 0 001-1V7.414a1 1 0 00-.293-.707l-5-5A1 1 0 009 2H6zm7 6V3.5L14.5 8H13a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Descargar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('crud-modal').addEventListener('submit', function(event) {
            var select = document.getElementById('paciente_id');
            if (select.value === '') {
                event.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, seleccione un paciente antes de continuar.',
                    confirmButtonColor: '#1D4ED8' // Este es el color bg-blue-700
                });
            }
        });
    </script>

</x-app-layout>