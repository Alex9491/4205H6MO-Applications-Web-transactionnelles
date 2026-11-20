@extends('layouts.app')

@section('title', __('interface.recipes'))

@section('content')
    <h1>{{ __('interface.recipes') }}</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

@auth
    <p class="create-recipe-action">
        <a href="{{ route('recettes.create') }}">
            {{ __('interface.create_recipe') }}
        </a>
    </p>
@endauth

    <div class="recipe-search">
        <label for="search">{{ __('interface.search') }}</label>
        <input id="search" type="search" autocomplete="off"
           data-search-url="{{ route('recherche.recettes') }}"
           data-searching="{{ __('interface.searching') }}"
           data-empty="{{ __('interface.no_results') }}"
           data-count="{{ __('interface.results') }}"
           data-error="{{ __('interface.search_error') }}">

        <p id="search-status" role="status" aria-live="polite"></p>
        <ul id="search-results"></ul>
    </div>

    @if ($recettes->isNotEmpty())
        <div class="recipe-grid">
            @foreach ($recettes as $recette)
                <article class="recipe-card">
                    @if ($recette->image_path)
                        <a class="recipe-card-image" href="{{ route('recettes.show', $recette) }}">
                            <img
                                src="{{ Storage::disk('public')->url($recette->image_path) }}"
                                alt="{{ $recette->nom }}"
                            >
                        </a>
                    @else
                        <a class="recipe-card-image recipe-card-placeholder" href="{{ route('recettes.show', $recette) }}" aria-label="{{ $recette->nom }}"></a>
                    @endif

                    <div class="recipe-card-body">
                        <h2>
                            <a href="{{ route('recettes.show', $recette) }}">
                                {{ $recette->nom }}
                            </a>
                        </h2>

                        <p class="recipe-meta">
                            {{ $recette->categorie?->nom ?? __('interface.no_category') }}
                        </p>

                        <p class="recipe-description">
                            {{ mb_substr($recette->description ?? '', 0, 20) }}@if (mb_strlen($recette->description ?? '') > 20)…@endif
                        </p>

                        <a class="recipe-card-link" href="{{ route('recettes.show', $recette) }}">
                            Voir la recette
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <p>{{ __('interface.no_recipes') }}</p>
    @endif

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
