@extends('layouts.app')

@section('title', __('interface.recipes'))

@section('content')
    <h1>{{ __('interface.recipes') }}</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <p>
        <a href="{{ route('recettes.create') }}">Créer une recette</a>
    </p>

    <label for="search">{{ __('interface.search') }}</label>
    <input id="search" type="search" autocomplete="off"
       data-search-url="{{ route('recherche.recettes') }}"
       data-searching="{{ __('interface.searching') }}"
       data-empty="{{ __('interface.no_results') }}"
       data-count="{{ __('interface.results') }}"
       data-error="{{ __('interface.search_error') }}">

    <p id="search-status" role="status" aria-live="polite"></p>
    <ul id="search-results"></ul>

    @forelse ($recettes as $recette)
        <article>
            <h2>
                <a href="{{ route('recettes.show', $recette) }}">
                    {{ $recette->nom }}
                </a>
            </h2>

            <p>
                Auteur : {{ $recette->user?->nom ?? 'Utilisateur inconnu' }}
            </p>

            <p>
                Catégorie : {{ $recette->categorie?->nom ?? 'Sans catégorie' }}
            </p>

            <p>{{ $recette->description }}</p>
        </article>

        <hr>
    @empty
        <p>Aucune recette disponible.</p>
    @endforelse

    {{ $recettes->links() }}
@endsection

@push('scripts')
    <script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush
