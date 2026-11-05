@extends('layouts.app')

@section('content')
    <h1>Accès refusé</h1>
    <p>Vous n'avez pas la permission d'effectuer cette action.</p>
    <a href="{{ route('recettes.index') }}">Retour à l'accueil</a>
@endsection