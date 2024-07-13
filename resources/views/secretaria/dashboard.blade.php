<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>  
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('¡Bienvenida Secretaria ') }} {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <span>{{ __("Tabla de pacientes") }}</span>
                    <div class="flex space-x-4">
                        <button data-modal-target="agendar-cita-modal" data-modal-toggle="agendar-cita-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Agendar cita
                        </button>
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
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre del paciente</th>
                            <th scope="col" class="px-6 py-3">Fecha</th>
                            <th scope="col" class="px-6 py-3">Hora</th>
                            <th scope="col" class="px-6 py-3">Teléfono</th>
                            <th scope="col" class="px-6 py-3">Servicio</th>
                            <th scope="col" class="px-6 py-3">Atendida</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas->where('atendida', 0) as $agenda)
                            @php
                                $paciente = $pacientes->find($agenda->id_paciente_agenda);
                                $servicio = $servicios->find($agenda->id_servicio_agenda);
                            @endphp
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $paciente->nombre_completo }}
                                </th>
                                <td class="px-6 py-4">{{ $agenda->fecha }}</td>
                                <td class="px-6 py-4">{{ $agenda->hora }}</td>
                                <td class="px-6 py-4">{{ $agenda->telefono }}</td>
                                <td class="px-6 py-4">{{ $servicio->Tipo }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('agendas.atendida', $agenda->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-1 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Últimas citas") }}
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nombre del paciente</th>
                            <th scope="col" class="px-6 py-3">Fecha</th>
                            <th scope="col" class="px-6 py-3">Hora</th>
                            <th scope="col" class="px-6 py-3">Teléfono</th>
                            <th scope="col" class="px-6 py-3">Regresar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($agendas->where('atendida', 1) as $agenda)
                            @php
                                $paciente = $pacientes->find($agenda->id_paciente_agenda);
                            @endphp
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $paciente->nombre_completo }}
                                </th>
                                <td class="px-6 py-4">{{ $agenda->fecha }}</td>
                                <td class="px-6 py-4">{{ $agenda->hora }}</td>
                                <td class="px-6 py-4">{{ $agenda->telefono }}</td>
                                <td class="px-6 py-4">
                                    <form method="POST" action="{{ route('agendas.desatendida', $agenda->id) }}">
                                        @csrf
                                        <button type="submit" class="bg-orange-400 hover:bg-orange-500 text-white font-bold py-1 px-1 rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal para agendar citas -->
    <div id="agendar-cita-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agendar Cita
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="agendar-cita-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form method="POST" action="{{ route('agendas.store') }}" class="p-4 md:p-5">
                    @csrf
                    <!-- Nombre del Paciente -->
                    <div class="mt-4">
                        <x-input-label for="id_paciente_agenda" :value="__('Nombre del Paciente')" />
                        <select id="id_paciente_agenda" name="id_paciente_agenda" class="block mt-1 w-full" onchange="updatePhoneNumber()">
                            <option value="">Seleccione un paciente</option>
                            @foreach($pacientes as $paciente)
                                <option value="{{ $paciente->id }}" data-telefono="{{ $paciente->telefono }}">{{ $paciente->nombre_completo }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_paciente_agenda')" class="mt-2" />
                    </div>

                    <!-- Fecha -->
                    <div class="mt-4">
                        <x-input-label for="fecha" :value="__('Fecha')" />
                        <x-text-input id="fecha" class="block mt-1 w-full" type="date" name="fecha" :value="old('fecha')" required />
                        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                    </div>

                    <!-- Hora -->
                    <div class="mt-4">
                        <x-input-label for="hora" :value="__('Hora')" />
                        <select id="hora" name="hora" class="block mt-1 w-full">
                            @for ($i = 8; $i <= 15; $i++)
                                <option value="{{ $i }}:00">{{ $i }}:00</option>
                            @endfor
                        </select>
                        <x-input-error :messages="$errors->get('hora')" class="mt-2" />
                    </div>

                    <!-- Teléfono -->
                    <div class="mt-4">
                        <x-input-label for="telefono" :value="__('Teléfono')" />
                        <x-text-input id="telefono" class="block mt-1 w-full" type="tel" name="telefono" :value="old('telefono')" />
                        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                    </div>

                    <!-- Servicio -->
                    <div class="mt-4">
                        <x-input-label for="id_servicio_agenda" :value="__('Servicio')" />
                        <select id="id_servicio_agenda" name="id_servicio_agenda" class="block mt-1 w-full">
                            <option value="">Seleccione un servicio</option>
                            @foreach($servicios as $servicio)
                                <option value="{{ $servicio->id }}">{{ $servicio->Tipo }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('id_servicio_agenda')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Registrar cita') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Codigo JS necesario para cuandos se agende cita se agrege automaticamente el numero del paciente -->
    <script>
        function updatePhoneNumber() {
            const select = document.getElementById('id_paciente_agenda');
            const selectedOption = select.options[select.selectedIndex];
            const telefono = selectedOption.getAttribute('data-telefono');
            document.getElementById('telefono').value = telefono ? telefono : '';
        }
    </script>
</x-app-layout>
