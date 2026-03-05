<?php

it('muestra escritorio y navegacion desplegable para usuarios autenticados', function () {
    $admin = createAdminUser();

    $this->actingAs($admin)
        ->get('/home')
        ->assertOk()
        ->assertSeeText('Escritorio')
        ->assertSee('seccion=termometros', false)
        ->assertSee('seccion=usuarios', false);
});

it('carga la seccion usuarios cuando la query seccion es usuarios', function () {
    $admin = createAdminUser();

    $this->actingAs($admin)
        ->get('/home?seccion=usuarios')
        ->assertOk()
        ->assertSeeText('Usuarios');
});
