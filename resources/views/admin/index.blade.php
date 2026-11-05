@extends('layouts.app')

@section('title', 'Administration')

@section('content')
    <h1>Administration</h1>

    <h2>Liste des utilisateurs</h2>

    @forelse ($utilisateurs as $utilisateur)
        <article>
            <h3>{{ $utilisateur->nom }}</h3>
            <p>Courriel : {{ $utilisateur->courriel }}</p>
            <p>Rôle : {{ $utilisateur->role }}</p>
        </article>
    @empty
        <p>Aucun utilisateur trouvé.</p>
    @endforelse
@endsections