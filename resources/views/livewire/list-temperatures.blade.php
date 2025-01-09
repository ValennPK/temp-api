<div>
    <h3>Datos del Termómetro: {{ $thermometerName }}</h3>
    <div>
        <div class="mb-3 d-flex align-items-center">
            <label for="startDate" class="form-label me-2">Desde:</label>
            <input type="date" wire:model="startDate" id="startDate" class="form-control me-2" style="width: 200px;">
            <label for="startTimeFilter" class="form-label me-2">Hora:</label>
            <input type="time" wire:model="startTimeFilter" id="startTimeFilter" class="form-control me-2">
        </div>
        <div class="mb-3 d-flex align-items-center">
            <label for="endDate" class="form-label me-2">Hasta:</label>
            <input type="date" wire:model="endDate" id="endDate" class="form-control me-2" style="width: 200px;">
            <label for="endTimeFilter" class="form-label me-2">Hora:</label>
            <input type="time" wire:model="endTimeFilter" id="endTimeFilter" class="form-control me-2">
        </div>

        <button wire:click="UpdateList" class="btn btn-primary mb-3">
            Actualizar
        </button>
        
        <button wire:click="toggleList" class="btn btn-primary mb-3">
            {{ $showList ? 'Ocultar' : 'Mostrar' }}
        </button>

        @if ($paginatedData)
        @if ($showList)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Port 1</th>
                    <th>Port 2</th>
                    <th>Port 3</th>
                    <th>Port 4</th>
                    <th>Port 5</th>
                    <th>Port 6</th>
                    <th>Port 7</th>
                    <th>Port 8</th>
                    <th>Creado</th>
                    <th>Actualizado</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($paginatedData as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->port1 }}</td>
                        <td>{{ $item->port2 }}</td>
                        <td>{{ $item->port3 }}</td>
                        <td>{{ $item->port4 }}</td>
                        <td>{{ $item->port5 }}</td>
                        <td>{{ $item->port6 }}</td>
                        <td>{{ $item->port7 }}</td>
                        <td>{{ $item->port8 }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11">No hay datos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="d-flex justify-content-center">
            {{ $paginatedData->links() }}
        </div>
        

        <div class="mb-3 d-flex align-items-center">
            <label for="recordsPerPage" class="form-label me-2"> Cantidad de registros:</label>
            <input type="number" wire:model="recordsPerPage" id="recordsPerPage" class="form-control me-2" min="10" max="25"  style="width: 100px;" placeholder="Max(100)">
        </div>
        
        @endif
    </div>

    @else
    <h3>{{ $message }}</h3>
    @endif
</div>
