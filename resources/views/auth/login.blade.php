@extends('layouts.app')

@section('title', 'Connexion')

@section('content')
    <h1>Connexion</h1>

    <form method="post" action="{{ route('login.store') }}">
        @csrf

        <label for="courriel">Adresse courriel</label>
        <input id="courriel" name="courriel" type="email" value="{{ old('courriel') }}" required>
        @error('courriel') <p>{{ $message }}</p> @enderror

        <label for="motdepasse">Mot de passe</label>
        <input id="motdepasse" name="motdepasse" type="password" required>

        <button type="submit">Se connecter</button>
    </form>
@endsection
