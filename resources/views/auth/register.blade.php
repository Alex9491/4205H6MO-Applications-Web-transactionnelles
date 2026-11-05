@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
    <h1>Créer un compte</h1>

    <form method="post" action="{{ route('register.store') }}">
        @csrf

        <label for="nom">Nom</label>
        <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required>
        @error('nom') <p>{{ $message }}</p> @enderror

        <label for="courriel">Adresse courriel</label>
        <input id="courriel" name="courriel" type="email" value="{{ old('courriel') }}" required>
        @error('courriel') <p>{{ $message }}</p> @enderror

        <label for="courriel_confirmation">Confirmer l'adresse courriel</label>
        <input id="courriel_confirmation" name="courriel_confirmation" type="email" value="{{ old('courriel_confirmation') }}" required>

        <label for="motdepasse">Mot de passe</label>
        <input id="motdepasse" name="motdepasse" type="password" required>
        @error('motdepasse') <p>{{ $message }}</p> @enderror

        <label for="motdepasse_confirmation">Confirmation du mot de passe</label>
        <input id="motdepasse_confirmation" name="motdepasse_confirmation" type="password" required>

        <button type="submit">Créer le compte</button>
    </form>
@endsection