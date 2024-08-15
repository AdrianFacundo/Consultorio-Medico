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
                    <span>{{ __("Tabla de productos") }}</span>
                    <div class="flex space-x-4">
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Agregar
                        </button>
                        <button data-modal-target="editar-product-modal" data-modal-toggle="editar-product-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Editar
                        </button>
                        <button data-modal-target="eliminar-product-modal" data-modal-toggle="eliminar-product-modal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Eliminar
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
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-gray-700 dark:bg-gray-800">
                        <tr>
                            <th scope="col" class="px-16 py-3">Muestra</th>
                            <th scope="col" class="px-6 py-3">Producto</th>
                            <th scope="col" class="px-6 py-3">Cantidad</th>
                            <th scope="col" class="px-6 py-3">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="p-4">
                                    <img src="{{ asset($producto->muestra) }}" class="w-16 md:w-32 max-w-full max-h-full" alt="{{ $producto->producto }}">
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $producto->producto }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    {{ $producto->cantidad }} ud.
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                    ${{ $producto->precio }} c/u.
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Agregar modal -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Agregar Producto
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <form id="agregar-form" class="p-4 md:p-5" enctype="multipart/form-data" action="{{ route('productos.store') }}" method="POST">
                    @csrf
                    <!-- Imagen -->
                    <div class="mb-4">
                        <label for="imagen" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Imagen</label>
                        <input type="file" id="imagen" name="imagen" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">Seleccione una imagen (opcional).</p>
                    </div>

                    <!-- Producto -->
                    <div class="mt-4">
                        <x-input-label for="producto" :value="__('Producto')" />
                        <x-text-input id="producto" class="block mt-1 w-full" type="text" name="producto" placeholder="Nombre del producto" required />
                        <x-input-error :messages="$errors->get('producto')" class="mt-2" />
                    </div>

                    <!-- Cantidad -->
                    <div class="mt-4">
                        <x-input-label for="cantidad" :value="__('Cantidad')" />
                        <x-text-input id="cantidad" class="block mt-1 w-full" type="number" name="cantidad" placeholder="Cantidad disponible" required />
                        <x-input-error :messages="$errors->get('cantidad')" class="mt-2" />
                    </div>

                    <!-- Precio -->
                    <div class="mt-4">
                        <x-input-label for="precio" :value="__('Precio')" />
                        <x-text-input id="precio" class="block mt-1 w-full" type="text" name="precio" placeholder="Precio del producto" required />
                        <x-input-error :messages="$errors->get('precio')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-10.707a1 1 0 00-1.414 0L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4a1 1 0 000-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Agregar Producto') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('precio').addEventListener('input', function (e) {
            const value = e.target.value;
            if (isNaN(value) || /[a-zA-Z]/.test(value)) {
                e.target.value = value.replace(/[^\d.]/g, '');
            }
        });

        document.getElementById('precio').addEventListener('keydown', function (e) {
            if (e.key >= 'a' && e.key <= 'z' || e.key >= 'A' && e.key <= 'Z') {
                e.preventDefault();
            }
        });
    </script>



<!-- Editar modal -->
<div id="editar-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Producto
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="editar-product-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form id="editar-form" class="p-4 md:p-5" enctype="multipart/form-data" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id" id="edit-product-id">
                <div class="mb-4">
                    <label for="select-producto" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Seleccionar Producto</label>
                    <select id="select-producto" name="producto" class="block w-full mt-1 text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="edit-imagen" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Imagen (opcional cambiarla)</label>
                    <input type="file" id="edit-imagen" name="imagen" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                </div>
                <div class="mt-4">
                    <label for="edit-producto" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Producto</label>
                    <input id="edit-producto" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="text" name="producto" placeholder="Nombre del producto" required>
                </div>
                <div class="mt-4">
                    <label for="edit-cantidad" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Cantidad</label>
                    <input id="edit-cantidad" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="number" name="cantidad" placeholder="Cantidad disponible" required>
                </div>
                <div class="mt-4">
                    <label for="edit-precio" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Precio</label>
                    <input id="edit-precio" class="block mt-1 w-full text-sm dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="number" inputmode="numeric" pattern="[0-9]*" name="precio" placeholder="Precio del producto" required>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Editar Producto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- JavaScript para cargar los datos del producto al seleccionar en el select -->
<script>
    document.getElementById('select-producto').addEventListener('change', function () {
        const selectedProducto = this.options[this.selectedIndex].value;
        const productos = @json($productos);
        const producto = productos.find(p => p.id == selectedProducto);

        if (producto) {
            const form = document.getElementById('editar-form');
            form.action = `/productos/${producto.id}`; // Update the form action URL
            document.getElementById('edit-product-id').value = producto.id;
            document.getElementById('edit-producto').value = producto.producto;
            document.getElementById('edit-cantidad').value = producto.cantidad;
            document.getElementById('edit-precio').value = producto.precio;
        }
    });
</script>


<!-- Modal para eliminar productos -->
<div id="eliminar-product-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Eliminar Producto
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="eliminar-product-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form method="POST" action="{{ route('productos.destroy', ['id' => 0]) }}" class="p-4 md:p-5" id="delete-product-form">
                @csrf
                @method('DELETE')

                <!-- Nombre del Producto -->
                <div class="mt-4">
                    <x-input-label for="delete_product_id" :value="__('Nombre del Producto')" />
                    <select id="delete_product_id" name="delete_product_id" class="block mt-1 w-full">
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->producto }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('delete_product_id')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="text-white inline-flex items-center bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        Eliminar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('delete-product-form').addEventListener('submit', function(event) {
        var select = document.getElementById('delete_product_id');
        if (select.value === '') {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Por favor, seleccione un producto antes de continuar.',
                confirmButtonColor: '#1D4ED8' // Este es el color bg-blue-700
            });
        }
    });
</script>
<!-- JavaScript -->
<script>
    document.getElementById('delete_product_id').addEventListener('change', function() {
        const form = document.getElementById('delete-product-form');
        form.action = "{{ url('/productos') }}/" + this.value;
    });
</script>
</x-app-layout>
