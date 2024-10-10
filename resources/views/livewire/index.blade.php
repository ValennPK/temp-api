<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/auth.css')
    <title>Document</title>
</head>
<body>

    <header>
        <nav>
            <h2>NAV</h2>
        </nav>
    </header>
{{-- --------------------------- --}}
<main>
    {{-- <article>
        <h2>ARTICLE</h2>
    </article>
    <aside>
        <h2>ASIDE</h2>
    </aside> --}}
    <article>
        <livewire:Auth.Register />
    </article>
    <article>
        <livewire:Auth.Login />
    </article>
</main>
{{-- --------------------------- --}}

<footer>
    <h2>FOOTER</h2>
</footer>

</body>
</html>