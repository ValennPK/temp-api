<?php

use App\Models\Thermometer;

it('retorna correctamente el endpoint de estado', function () {
    $this->getJson('/api/status')
        ->assertOk()
        ->assertJson(['message' => 'El servidor está funcionando correctamente']);
});

it('registra un termometro por api', function () {
    $payload = [
        'username' => 'termometro_001',
        'password' => 'password123',
    ];

    $this->postJson('/api/register', $payload)
        ->assertCreated()
        ->assertJsonFragment(['message' => 'Thermomether created successfully']);

    $thermometer = Thermometer::where('username', 'termometro_001')->first();
    expect($thermometer)->not->toBeNull();
});

it('deniega login api cuando el termometro no tiene permiso', function () {
    createThermometer([
        'username' => 'blocked_sensor',
        'password' => 'password123',
    ], false);

    $this->postJson('/api/login', [
        'username' => 'blocked_sensor',
        'password' => 'password123',
    ])
        ->assertUnauthorized()
        ->assertJson(['error' => 'You do not have permission']);
});

it('retorna token sanctum para termometro con permiso', function () {
    createThermometer([
        'username' => 'sensor_ok',
        'password' => 'password123',
    ], true);

    $this->postJson('/api/login', [
        'username' => 'sensor_ok',
        'password' => 'password123',
    ])
        ->assertOk()
        ->assertJsonStructure(['token']);
});
