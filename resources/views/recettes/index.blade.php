@extends('layouts.app')

@section('title', __('interface.recipes'))

@section('content')
    <h1>{{ __('interface.recipes') }}</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

@auth
    <a href="{{ route('recettes.create') }}">
        {{ __('interface.create_recipe') }}
    </a>
@endauth

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
                {{ __('interface.author') }} :
                {{ $recette->user?->nom ?? __('interface.unknown_user') }}
            </p>

            <p>
                {{ __('interface.category') }} :
                {{ $recette->categorie?->nom ?? __('interface.no_category') }}
            </p>

            <p>{{ $recette->description }}</p>
        </article>

        <hr>
    @empty
        <p>{{ __('interface.no_recipes') }}</p>
    @endforelse

    @if ($recettes->hasPages())
        <nav class="pagination" aria-label="Pagination">
            @if ($recettes->onFirstPage())
                <span class="pagination-disabled" aria-disabled="true">{{ __('pagination.previous') }}</span>
            @else
                <a href="{{ $recettes->previousPageUrl() }}" rel="prev">{{ __('pagination.previous') }}</a>
            @endif

            @if ($recettes->hasMorePages())
                <a href="{{ $recettes->nextPageUrl() }}" rel="next">{{ __('pagination.next') }}</a>
            @else
                <span class="pagination-disabled" aria-disabled="true">{{ __('pagination.next') }}</span>
            @endif
        </nav>
    @endif
@endsection

@push('scripts')
    <script src="{{ asset('js/recherche.js') }}" defer></script>
@endpush
