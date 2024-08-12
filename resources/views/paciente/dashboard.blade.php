<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('¡Bienvenid@ Paciente ') }} {{ Auth::user()->name }}!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Citas proximas") }}
                </div>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-gray-700 dark:bg-gray-800">                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Hora
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($agendas->where('atendida', 0) as $agenda)
                            @php
                                $paciente = $pacientes->find($agenda->id_paciente_agenda);
                            @endphp
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">
                                    {{ $agenda->fecha }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $agenda->hora }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-gray-100 border border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                <td colspan="2" class="px-6 py-4 text-center text-gray-700 dark:text-gray-300 font-semibold">
                                    ¡No hay citas proximas, reserva ahora!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
