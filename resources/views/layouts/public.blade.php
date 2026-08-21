<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Website resmi Pesantren Darel Arifien"
    >

    <title>
        @yield('title', 'Pesantren Darel Arifien')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body
    class="bg-white
           text-gray-900
           antialiased"
>


    {{-- HEADER --}}

    @include('partials.public-navbar')


    {{-- MAIN --}}

    <main>

        @yield('content')

    </main>


    {{-- FOOTER --}}

    @include('partials.public-footer')


</body>

</html>