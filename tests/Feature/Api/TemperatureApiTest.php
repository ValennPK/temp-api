<?php

use App\Models\Thermometer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    // Dynamic per-thermometer tables are created by runtime code and can persist
    // depending on transaction behavior in MySQL, so we force clean state.
    Schema::dropIfExists('sensor_a');
});

it('almacena una fila de temperatura y crea las tablas requeridas', function () {
    $thermometer = createThermometer(['username' => 'sensor_a'], true);
    Sanctum::actingAs($thermometer, ['*']);

    $this->postJson('/api/sensor_a/temperatures', [
        'port1' => 23.5,
    ])
        ->assertCreated()
        ->assertJson(['message' => 'Temperature stored successfully']);

    expect(Schema::hasTable('sensor_a'))->toBeTrue();
    expect(DB::table('sensor_a')->count())->toBe(1);

    $row = DB::table('sensor_a')->latest('id')->first();
    expect((float) $row->port1)->toBe(23.5);

    $this->assertDatabaseHas('setpoint_hysteresis', [
        'name' => 'sensor_a',
    ]);
});

it('valida que se envie al menos un puerto', function () {
    $thermometer = createThermometer(['username' => 'sensor_a'], true);
    Sanctum::actingAs($thermometer, ['*']);

    $this->postJson('/api/sensor_a/temperatures', [])
        ->assertStatus(422)
        ->assertJsonFragment([
            'message' => 'Validation failed',
        ]);
});

it('almacena multiples filas de temperatura desde endpoint masivo', function () {
    $thermometer = createThermometer(['username' => 'sensor_a'], true);
    Sanctum::actingAs($thermometer, ['*']);

    $this->postJson('/api/sensor_a/mass_temperatures', [
        'dato1' => 10.1,
        'dato2' => 10.2,
        'dato3' => 10.3,
    ])
        ->assertCreated()
        ->assertJson(['message' => 'Multiple temperature stored successfully']);

    expect(DB::table('sensor_a')->count())->toBe(3);
});

it('retorna error de validacion cuando la carga masiva esta vacia', function () {
    $thermometer = createThermometer(['username' => 'sensor_a'], true);
    Sanctum::actingAs($thermometer, ['*']);

    $this->postJson('/api/sensor_a/mass_temperatures', [])
        ->assertStatus(422)
        ->assertJsonFragment([
            'message' => 'Validation failed',
        ]);
});

it('retorna el ultimo dato y datos indexados de temperatura', function () {
    $thermometer = createThermometer(['username' => 'sensor_a'], true);
    Sanctum::actingAs($thermometer, ['*']);

    $this->postJson('/api/sensor_a/temperatures', ['port1' => 20.5])->assertCreated();
    $this->postJson('/api/sensor_a/temperatures', ['port1' => 21.7])->assertCreated();

    $this->getJson('/api/data/last/sensor_a')
        ->assertOk()
        ->assertJsonStructure(['id', 'port1', 'created_at', 'updated_at']);

    $response = $this->getJson('/api/data/index/sensor_a/1')
        ->assertOk()
        ->json();

    expect($response)->toBeArray();
    expect($response)->not->toBeEmpty();
    expect($response[0])->toHaveKeys(['name', 'port', 'valor', 'entry_id', 'read_at', 'status']);
});

it('requiere autenticacion sanctum en endpoints protegidos de temperatura', function () {
    createThermometer(['username' => 'sensor_a'], true);

    $this->postJson('/api/sensor_a/temperatures', ['port1' => 22])
        ->assertUnauthorized();
});
