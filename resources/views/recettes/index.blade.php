<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des recettes</title>
</head>
<body>
    <h1>Liste des recettes</h1>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <p>
        <a href="{{ route('recettes.create') }}">Créer une recette</a>
    </p>

    <label for="search">Rechercher une recette</label>
    <input id="search" type="search" autocomplete="off"
       data-search-url="{{ route('recherche.recettes') }}"
       data-searching="Recherche en cours..."
       data-empty="Aucun résultat."
       data-count=":count résultat(s)."
       data-error="Recherche temporairement indisponible.">

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
    <script src="{{ asset('js/recherche.js') }}" defer></script>
</body>
</html>
