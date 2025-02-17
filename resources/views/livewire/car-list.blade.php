<div>
    <h1 class="mb-4 font-bold text-2x1">MIS COCHES</h1>
    <h2>{{ $nombre }}</h2>
    Buscar: <input type="text" wire:model.live='buscador'><br>
    @livewire('create-car')
    @if($cars->count())
    <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
        <thead
            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th wire:click="ordenar('id')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'id')
                        <p class="text-red-600">ID</p>
                        @else
                        ID
                    @endif

                </th>
                <th wire:click="ordenar('matricula')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'matricula')
                        <p class="text-red-600">Matricula</p>
                        @else
                        Matricula
                    @endif
                </th>
                <th wire:click="ordenar('marca')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'marca')
                        <p class="text-red-600">Marca</p>
                        @else
                        Marca
                    @endif
                </th>
                <th wire:click="ordenar('modelo')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'modelo')
                        <p class="text-red-600">Modelo</p>
                        @else
                        Modelo
                    @endif
                </th>
                <th wire:click="ordenar('year')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'year')
                        <p class="text-red-600">Año</p>
                        @else
                        Año
                    @endif
                </th>
                <th wire:click="ordenar('color')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'color')
                        <p class="text-red-600">Color</p>
                        @else
                        Color
                    @endif
                </th>
                <th wire:click="ordenar('fecha_ultima_revision')" scope="col" class="px-6 py-3 cursor-pointer">
                    @if($campoOrden == 'fecha_ultima_revision')
                        <p class="text-red-600">Fecha Ultima Revision</p>
                        @else
                        Fecha Ultima Revision
                    @endif
                </th>

            </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
                <tr
                    class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $car->id }}
                    </th>
                    <th scope="row"
                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $car->matricula }}
                </th>
                    <td class="px-6 py-4">
                        {{ $car->marca }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $car->modelo }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $car->year }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $car->color }}

                    </td>
                    <td class="px-6 py-4">
                        {{ $car->fecha_ultima_revision }}

                    </td>


                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <div>
        NO ESISTE NINGUN COCHE FILTRADO
    </div>
    @endif

</div>
