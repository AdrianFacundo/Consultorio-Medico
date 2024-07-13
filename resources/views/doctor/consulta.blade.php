<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>
<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card for Patient Information -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6 p-4 flex justify-between items-center">
                <div class="flex items-center">
                    <div class="bg-orange-500 rounded-full w-12 h-12 flex items-center justify-center text-white text-lg font-semibold mr-4">AP</div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Andrea Perez</h2>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-mars text-blue-500 mr-1"></i>
                        Femenino
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-hourglass-half text-blue-500 mr-1"></i>
                        1 mes
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-calendar-alt text-blue-500 mr-1"></i>
                        11 Enero, 2024
                    </div>
                    <div class="flex items-center text-gray-700">
                        <i class="fas fa-mobile-alt text-blue-500 mr-1"></i>
                        1
                    </div>
                </div>
            </div>

            <!-- Card for Diagnosis and Previous Treatment -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-2xl font-semibold text-gray-700">Diagnóstico y tratamiento previo</h2>
                        </div>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diagnóstico</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Medicamento</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">10 Jul, 2024</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dolor abdominal</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">paracetamol</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Card for Vital Signs -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col space-y-4">
                        <div class="flex justify-between items-center">
                            <h2 class="text-2xl font-semibold text-gray-700">Signos vitales</h2>
                            <button class="text-orange-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        <div class="grid grid-cols-3 gap-6">
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl text-blue-500">
                                    <i class="fas fa-ruler-vertical"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold">1.12 m</p>
                                    <p class="text-sm text-gray-500">Talla</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl text-blue-500">
                                    <i class="fas fa-thermometer-half"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold">36.5 °C</p>
                                    <p class="text-sm text-gray-500">Temperatura</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl text-blue-500">
                                    <i class="fas fa-weight"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold">25 kg</p>
                                    <p class="text-sm text-gray-500">Peso</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl text-blue-500">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold">110/70 (mm/Hg)</p>
                                    <p class="text-sm text-gray-500">Tensión arterial</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl text-blue-500">
                                    <i class="fas fa-lungs"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold">93 %</p>
                                    <p class="text-sm text-gray-500">Saturación de oxígeno</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="text-3xl text-blue-500">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold">60 bpm</p>
                                    <p class="text-sm text-gray-500">Frecuencia cardíaca</p>
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
                        <textarea class="w-full h-32 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe el motivo de la consulta..."></textarea>
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
                        <form>
                            <div class="grid grid-cols-4 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Medicación</label>
                                    <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Medicación">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Cantidad</label>
                                    <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cantidad">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Frecuencia</label>
                                    <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Frecuencia">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Duración</label>
                                    <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Duración">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Notas</label>
                                <textarea class="mt-1 block w-full h-24 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Agregar notas..."></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Agregar medicamento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
