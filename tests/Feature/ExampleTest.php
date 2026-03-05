<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_la_aplicacion_retorna_una_respuesta_exitosa(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
