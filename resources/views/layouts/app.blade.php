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
        content="Website Resmi Pesantren {{ $settings['school_name'] ?? '' }}"
    >

    <meta
        name="author"
        content="Pesantren {{ $settings['school_name'] ?? '' }}"
    >

    <title>
        @yield('title', 'Pesantren ' . ($settings['school_name'] ?? ''))
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')
</head>

<body class="bg-white text-gray-900 antialiased">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    @stack('scripts')

</body>
</html>