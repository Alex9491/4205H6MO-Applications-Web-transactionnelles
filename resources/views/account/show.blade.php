@extends('layouts.app')

@section('title', 'Mon compte')

@section('content')
    <h1>Mon compte</h1>

    <h2>Informations personnelles</h2>
    <p>Nom : {{ $user->nom }}</p>
    <p>Courriel : {{ $user->courriel }}</p>

    <h2>Mes recettes</h2>

    @forelse ($recettes as $recette)
        <article>
            <h3>{{ $recette->nom }}</h3>
            <p>{{ $recette->description }}</p>
        </article>
    @empty
        <p>Vous n'avez pas encore créé de recettes.</p>
    @endforelse
@endsection