@extends('layouts.public')

@section('title', 'Inicio')

@section('content')
    <div class="p-5 mb-4 bg-light rounded-3 border">
        <div class="container-fluid py-3">
            <h1 class="display-6 fw-bold">Bienvenido a {{ config('app.name', 'Temp API') }}</h1>
            <p class="col-md-10 fs-5 mb-0">
                Plataforma para monitoreo de temperatura y gesti&oacute;n de datos en tiempo real.
                Desde aqu&iacute; puedes conocer nuestra propuesta y acceder al panel privado.
            </p>
        </div>
    </div>
@endsection
