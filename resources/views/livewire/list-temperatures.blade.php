<div>
    @if ($data)
    <h3>Datos del Termómetro: {{ $thermometerName }}</h3>
    <div>
        <div class="mb-3 d-flex align-items-center">
            <label for="recordsPerPage" class="form-label me-2"> Cantidad de registros:</label>
            <input type="number" wire:model="recordsPerPage" id="recordsPerPage" class="form-control me-2" min="1" max="100"  style="width: 100px;" placeholder="Max(100)">
        </div>
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
        
        @if ($showList)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Port1</th>
                    <th>Port2</th>
                    <th>Port3</th>
                    <th>Port4</th>
                    <th>Port5</th>
                    <th>Port6</th>
                    <th>Port7</th>
                    <th>Port8</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $temperature)
                <tr>
                    <td>{{ $temperature->id }}</td>
                    <td>{{ $temperature->port1 }}</td>
                    <td>{{ $temperature->port2 }}</td>
                    <td>{{ $temperature->port3 }}</td>
                    <td>{{ $temperature->port4 }}</td>
                    <td>{{ $temperature->port5 }}</td>
                    <td>{{ $temperature->port6 }}</td>
                    <td>{{ $temperature->port7 }}</td>
                    <td>{{ $temperature->port8 }}</td>
                    <td>{{ $temperature->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        @endif

    @else
    <h3>{{ $message }}</h3>
    @endif
</div>


{{-- <table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Port1</th>
            <th>Port2</th>
            <th>Port3</th>
            <th>Port4</th>
            <th>Port5</th>
            <th>Port6</th>
            <th>Port7</th>
            <th>Port8</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $temperature)
        <tr>
            <td>{{ $temperature->id }}</td>
            <td>{{ $temperature->port1 }}</td>
            <td>{{ $temperature->port2 }}</td>
            <td>{{ $temperature->port3 }}</td>
            <td>{{ $temperature->port4 }}</td>
            <td>{{ $temperature->port5 }}</td>
            <td>{{ $temperature->port6 }}</td>
            <td>{{ $temperature->port7 }}</td>
            <td>{{ $temperature->port8 }}</td>
            <td>{{ $temperature->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div> --}}