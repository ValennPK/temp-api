<div>
    @if ($data)
    <h3>Datos del Termómetro: {{ $thermometerName }}</h3>
    <div>
        <button wire:click="toggleList" class="btn btn-primary mb-3">
            {{ $showList ? 'Ocultar' : 'Mostrar' }}
        </button>
        <button href="{{ url('/') }}" class="btn btn-primary mb-3">
            Volver
        </button>
    </div>
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
        @endif
    @else
    <h3>{{ $message }}</h3>
    @endif
</div>