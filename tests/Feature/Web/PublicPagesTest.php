<?php

it('renderiza paginas publicas sin autenticacion', function () {
    $this->get('/')
        ->assertOk()
        ->assertViewIs('public.inicio');

    $this->get('/vision-mision')
        ->assertOk()
        ->assertViewIs('public.vision-mision');

    $this->get('/quienes-somos')
        ->assertOk()
        ->assertViewIs('public.quienes-somos');

    $this->get('/servicios')
        ->assertOk()
        ->assertViewIs('public.servicios');
});

it('muestra boton login para invitados y privado para usuarios autenticados', function () {
    $this->get('/')->assertOk()->assertSeeText('Login');

    $admin = createAdminUser();
    $this->actingAs($admin)
        ->get('/')
        ->assertOk()
        ->assertSeeText('Privado');
});

it('protege la ruta de escritorio para invitados', function () {
    $this->get('/home')->assertRedirect('/login');
});
