<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', __('interface.recipes'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    @stack('scripts')
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="site-title" href="{{ route('recettes.index') }}">
                Collection collaborative de recettes et de menus
            </a>

            <div class="header-actions">
                @auth
                    <a class="header-link" href="{{ route('account.show') }}">Mon compte</a>

                    @if (auth()->user()?->role === \App\Models\User::ROLE_MANAGER)
                        <a class="header-link" href="{{ route('admin.index') }}">Administration</a>
                    @endif

                    <form class="header-form" method="post" action="{{ route('logout') }}">
                        @csrf
                        <button class="header-button" type="submit">Se déconnecter</button>
                    </form>
                @else
                    <a class="header-link" href="{{ route('login') }}">Connexion</a>
                    <a class="header-link" href="{{ route('register') }}">Inscription</a>
                @endauth

                <form class="language-form" method="post" action="{{ route('locale.update') }}">
                    @csrf
                    <label for="locale">Langue</label>
                    <select id="locale" name="locale">
                        <option value="fr" @selected(app()->getLocale() === 'fr')>Français</option>
                        <option value="en" @selected(app()->getLocale() === 'en')>English</option>
                    </select>
                    <button class="header-button" type="submit">{{ __('interface.apply') }}</button>
                </form>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

</body>
</html>
