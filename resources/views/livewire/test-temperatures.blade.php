@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
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
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Port1</th>
                                                <th>Port2</th>
                                                <!-- Agrega más columnas según sea necesario -->
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $row)
                                                <tr>
                                                    <td>{{ $row->id }}</td>
                                                    <td>{{ $row->port1 }}</td>
                                                    <td>{{ $row->port2 }}</td>
                                                    <!-- Agrega más columnas -->
                                                    <td>{{ $row->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                
                                    <!-- Renderiza los enlaces de paginación -->
                                    {{ $data->links() }}
                                </div>
                                
                                @endif
                            </div>
                        
                            @else
                            <h3>{{ $message }}</h3>
                            @endif
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection