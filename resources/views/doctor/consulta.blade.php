<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card for Patient Information -->
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <div
                        class="bg-orange-500 rounded-full w-12 h-12 flex items-center justify-center text-white text-lg font-semibold mr-4">
                        {{ substr($paciente->nombre_completo, 0, 1) . substr(explode(' ',
                        $paciente->nombre_completo)[1], 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">{{ $paciente->nombre_completo
                            }}</h2>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <i class="fas fa-mars text-blue-500 mr-1"></i>
                        {{ $paciente->genero }}
                    </div>
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <i class="fas fa-solid fa-mobile text-blue-500 mr-1"></i>
                        {{ substr($paciente->telefono, 0, 3) . '-' . substr($paciente->telefono, 3, 3) . '-' .
                        substr($paciente->telefono, 6) }}
                    </div>
                    <div class="flex items-center text-gray-700 dark:text-gray-300">
                        <i class="fas fa-calendar-alt text-blue-500 mr-1"></i>
                        {{ $paciente->fecha_nacimiento}}
                    </div>
                </div>
            </div>
            <!-- Card for Diagnosis and Previous Treatment -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-gray-700">Tratamiento previo</h2>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Motivo de consulta
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Medicamento
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($citas as $cita)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $cita->fecha }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cita->motivo_consulta }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $cita->producto->producto }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-gray-100 border border-gray-300 dark:bg-gray-700 dark:border-gray-600">
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-700 dark:text-gray-300 font-semibold">
                                            Sin tratamiento previo
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('citas.store') }}">
                @csrf
                <input type="hidden" name="id_agenda" value="{{ $agenda->id }}">
                <input type="hidden" name="id_paciente_citas" value="{{ $paciente->id }}">
                <input type="hidden" name="id_servicio_citas" value="{{ $servicio->id }}">
                <input type="hidden" name="fecha" value="{{ $agenda->fecha }}">
                <!-- Card for Vital Signs -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col space-y-4">
                            <div class="flex justify-between items-center">
                                <h2 class="text-2xl font-semibold text-gray-700">Signos vitales</h2>
                            </div>
                            <div id="vital-signs-grid" class="grid grid-cols-3 gap-6">
                                <div class="flex items-center space-x-3">
                                    <div class="text-3xl text-blue-500">
                                        <i class="fas fa-ruler-vertical"></i>
                                    </div>
                                    <div>
                                        <input type="text" id="estatura" name="estatura"
                                            class="mt-1 block w-3/4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="0.00">
                                        <p class="text-sm text-gray-500">Estatura (metros)</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="text-3xl text-blue-500">
                                        <i class="fas fa-thermometer-half"></i>
                                    </div>
                                    <div>
                                        <input type="text" id="temperatura" name="temperatura"
                                            class="mt-1 block w-3/4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="0">
                                        <p class="text-sm text-gray-500">Temperatura (°C)</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="text-3xl text-blue-500">
                                        <i class="fas fa-weight"></i>
                                    </div>
                                    <div>
                                        <input type="text" id="peso" name="peso"
                                            class="mt-1 block w-3/4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="0.00">
                                        <p class="text-sm text-gray-500">Peso (kg)</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="text-3xl text-blue-500">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <div>
                                        <input type="text" id="tension" name="tension"
                                            class="mt-1 block w-3/4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="0/0">
                                        <p class="text-sm text-gray-500">Tensión arterial (mm/Hg)</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="text-3xl text-blue-500">
                                        <i class="fas fa-lungs"></i>
                                    </div>
                                    <div>
                                        <input type="text" id="oxigeno" name="oxigeno"
                                            class="mt-1 block w-3/4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="0">
                                        <p class="text-sm text-gray-500">Saturación de oxígeno (%)</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="text-3xl text-blue-500">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div>
                                        <input type="text" id="frecuencia_cardiaca" name="frecuencia_cardiaca"
                                            class="mt-1 block w-3/4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            placeholder="0">
                                        <p class="text-sm text-gray-500">Frecuencia cardíaca (bpm)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card for Consultation Reason -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-2xl font-semibold text-gray-700">Motivo de la consulta</h2>
                            </div>
                            <textarea id="motivo_consulta" name="motivo_consulta"
                                class="w-full h-32 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Describe el motivo de la consulta..."></textarea>
                        </div>
                    </div>
                </div>
                
                <!-- Card for Prescription -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="bg-white shadow-md rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h2 class="text-2xl font-semibold text-gray-700">Receta</h2>
                            </div>
                            <div class="grid grid-cols-4 gap-4 mb-4">
                                <div class="mb-4">
                                    <label for="medicacion" class="block text-sm font-medium text-gray-700 mb-1">Medicación</label>
                                    <select id="medicacion" name="id_producto_citas" class="block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad</label>
                                    <input type="text" id="cantidad" name="cantidad"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Cantidad">
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const cantidadInput = document.getElementById('cantidad');

                                        cantidadInput.addEventListener('input', function () {
                                            this.value = this.value.replace(/[^0-9]/g, '');
                                        });
                                    });
                                </script>
                                <div>
                                    <label for="frecuencia" class="block text-sm font-medium text-gray-700">Frecuencia</label>
                                    <input type="text" id="frecuencia" name="frecuencia"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Frecuencia">
                                </div>
                                <div>
                                    <label for="duracion" class="block text-sm font-medium text-gray-700">Duración</label>
                                    <input type="text" id="duracion" name="duracion"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="Duración">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="nota" class="block text-sm font-medium text-gray-700">Notas</label>
                                <textarea id="nota" name="nota"
                                    class="mt-1 block w-full h-24 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Agregar notas..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Terminar consulta</button>
                </div>
            </form>

        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const estaturaInput = document.getElementById('estatura');
        const pesoInput = document.getElementById('peso');
        const temperaturaInput = document.getElementById('temperatura');
        const tensionInput = document.getElementById('tension');
        const oxigenoInput = document.getElementById('oxigeno');
        const frecuenciaCardiacaInput = document.getElementById('frecuencia_cardiaca');

        estaturaInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
            if (!/^\d{0,1}(\.\d{0,2})?$/.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });

        pesoInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9.]/g, '');
            if (!/^\d{0,3}(\.\d{0,2})?$/.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });

        temperaturaInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (!/^\d{0,2}$/.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });

        tensionInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9/]/g, '');
            if (!/^\d{0,3}(\/\d{0,3})?$/.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });

        oxigenoInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (!/^\d{0,2}$/.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });

        frecuenciaCardiacaInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (!/^\d{0,3}$/.test(this.value)) {
                this.value = this.value.slice(0, -1);
            }
        });
    });
</script>

</x-app-layout>