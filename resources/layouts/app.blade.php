<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Recettes')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('scripts')
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>
