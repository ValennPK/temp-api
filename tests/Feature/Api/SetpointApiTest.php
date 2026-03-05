<?php

use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->thermometer = createThermometer([
        'username' => 'sensor_setpoint',
    ], true);

    Sanctum::actingAs($this->thermometer, ['*']);
});

it('crea y consulta setpoints por api', function () {
    $payload = [
        'upper_s1' => 30, 'lower_s1' => 20,
        'upper_s2' => 30, 'lower_s2' => 20,
        'upper_s3' => 30, 'lower_s3' => 20,
        'upper_s4' => 30, 'lower_s4' => 20,
        'upper_s5' => 30, 'lower_s5' => 20,
        'upper_s6' => 30, 'lower_s6' => 20,
        'upper_s7' => 30, 'lower_s7' => 20,
    ];

    $this->postJson('/api/sensor_setpoint/setpoints', $payload)
        ->assertCreated()
        ->assertJsonFragment(['name' => 'sensor_setpoint']);

    $this->getJson('/api/sensor_setpoint/setpoints')
        ->assertOk()
        ->assertJsonFragment(['name' => 'sensor_setpoint']);
});

it('valida diferencia minima entre upper y lower en setpoints', function () {
    $payload = [
        'upper_s1' => 21, 'lower_s1' => 20,
        'upper_s2' => 30, 'lower_s2' => 20,
        'upper_s3' => 30, 'lower_s3' => 20,
        'upper_s4' => 30, 'lower_s4' => 20,
        'upper_s5' => 30, 'lower_s5' => 20,
        'upper_s6' => 30, 'lower_s6' => 20,
        'upper_s7' => 30, 'lower_s7' => 20,
    ];

    $this->postJson('/api/sensor_setpoint/setpoints', $payload)
        ->assertStatus(422);
});
