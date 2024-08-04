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
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Cobrar consulta
                        </button>
                    </div>
                </div>
            </div>
            @if (session('success'))
                <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
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
                                Medicacion
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Estado de pago
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
                                    {{ $producto->producto }}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap 
                                    {{ $cita->estado == 'Pagado' ? 'text-green-500' : ($cita->estado == 'No pagado' ? 'text-red-500' : '') }}">
                                    {{ $cita->estado }}
                                </th>
                            </tr>
                        @endforeach
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
                        Pago de consulta
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('citas.pagada') }}" class="p-4 md:p-5">
                    @csrf
                    <!-- Nombre del Paciente -->
                    <div class="mt-4">
                        <x-input-label for="delete_patient_id" :value="__('Nombre del Paciente')" />
                        <select id="delete_patient_id" name="delete_patient_id" class="block mt-1 w-full" onchange="updateTotal()">
                            <option value="">Seleccione un paciente</option>
                            @foreach($citas as $cita)
                                @if($cita->estado === 'No pagado')
                                    @php
                                        $paciente = $pacientes->find($cita->id_paciente_citas);
                                    @endphp
                                    @if($paciente)
                                        <option value="{{ $paciente->id }}" data-total="{{ $cita->total }}">{{ $paciente->nombre_completo }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('delete_patient_id')" class="mt-2" />
                    </div>

                    <!-- Metodo de pago -->
                    <div class="mt-4">
                        <x-input-label for="edit" :value="__('Metodo de pago')" />
                        <select id="edit" name="edit" class="block mt-1 w-full">
                            <option value="Tarjeta">Tarjeta</option>
                            <option value="Efectivo">Efectivo</option>
                        </select>
                        <x-input-error :messages="$errors->get('edit')" class="mt-2" />
                    </div>

                    <!-- Total a pagar -->
                    <div class="mt-4">
                        <x-input-label for="total" :value="__('Total a Pagar')" />
                        <input id="total" name="total" type="text" class="block mt-1 w-full" readonly />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Registrar pago
                        </button>
                    </div>
                </form>

                <script>
                function updateTotal() {
                    const select = document.getElementById('delete_patient_id');
                    const selectedOption = select.options[select.selectedIndex];
                    const total = selectedOption.getAttribute('data-total');
                    document.getElementById('total').value = total ? total : '';
                }
                </script>

            </div>
        </div>
    </div> 
</x-app-layout>
