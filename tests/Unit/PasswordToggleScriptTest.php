<?php

it('contiene logica global de mostrar y ocultar contrasena en app js', function () {
    $content = file_get_contents(resource_path('js/app.js'));

    expect($content)
        ->toContain('enhancePasswordInput')
        ->toContain('input[type="password"]')
        ->toContain('MutationObserver');
});
