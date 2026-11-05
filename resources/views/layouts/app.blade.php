<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('interface.recipes'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('scripts')
</head>
<body>
    @auth
    <form method="post" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Se déconnecter</button>
    </form>
    @else
    <a href="{{ route('login') }}">Connexion</a>
    <a href="{{ route('register') }}">Inscription</a>
    @endauth


    <form method="post" action="{{ route('locale.update') }}">
        @csrf

        <label for="locale">{{ __('interface.language') }}</label>

        <select id="locale" name="locale">
            <option value="fr" @selected(app()->getLocale() === 'fr')>
                Français
            </option>
            <option value="en" @selected(app()->getLocale() === 'en')>
                English
            </option>
        </select>

        <button type="submit">{{ __('interface.apply') }}</button>
    </form>

    <main>
        @yield('content')
    </main>

</body>
</html>
