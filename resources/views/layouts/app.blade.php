<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Laravel App' }}</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <header>
        <nav>
            <!-- Тут можно меню -->
        </nav>
    </header>

    <main class="py-6 px-4">
        {{ $slot }}
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} My Laravel App</p>
    </footer>

    @livewireScripts
</body>

</html>
