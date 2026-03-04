@extends('layouts.public')

@section('title', 'Nuestros servicios')

@section('content')
    <h1 class="mb-4">Nuestros servicios</h1>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">Monitoreo en tiempo real</h2>
                    <p class="card-text mb-0">
                        Seguimiento continuo de variables de temperatura con paneles de consulta claros.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">Alertas y eventos</h2>
                    <p class="card-text mb-0">
                        Notificaciones autom&aacute;ticas ante valores fuera de rango y ausencia de lecturas.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h2 class="h5 card-title">Soporte de integraci&oacute;n</h2>
                    <p class="card-text mb-0">
                        Asesoramiento para integrar sensores, API y procesos operativos del negocio.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
