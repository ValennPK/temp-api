@extends('layouts.app')

@section('content')
@php
    $seccion = request()->query('seccion', 'termometros');
    if (!in_array($seccion, ['termometros', 'usuarios'], true)) {
        $seccion = 'termometros';
    }
@endphp

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Escritorio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($seccion === 'usuarios')
                        @livewire('list-users')
                    @else
                        @livewire('list-thermometers')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
