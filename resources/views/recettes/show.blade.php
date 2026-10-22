<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recette->nom }}</title>
</head>
<body>
    <p>
        <a href="{{ route('recettes.index') }}">Retour aux recettes</a>
    </p>

    @if (session('status'))
        <p>{{ session('status') }}</p>
    @endif

    <h1>{{ $recette->nom }}</h1>

    <p>
        Auteur : {{ $recette->user?->nom ?? 'Utilisateur inconnu' }}
    </p>

    <p>
        Catégorie : {{ $recette->categorie?->nom ?? 'Sans catégorie' }}
    </p>

    <p>{{ $recette->description }}</p>

    <p>
        <a href="{{ route('recettes.edit', $recette) }}">Modifier</a>
    </p>

    <form method="post" action="{{ route('recettes.destroy', $recette) }}">
        @csrf
        @method('DELETE')

        <button type="submit">Supprimer</button>
    </form>

    <hr>

    <h2>Avis</h2>

    @forelse ($recette->avis as $avis)
        <article>
            <p>
                Note : {{ $avis->note ?? 'Aucune note' }}/5
            </p>

            <p>
                Auteur de l'avis :
                {{ $avis->user?->nom ?? 'Utilisateur inconnu' }}
            </p>

            @if ($avis->dateavis)
                <p>
                    Date : {{ $avis->dateavis->format('d/m/Y') }}
                </p>
            @endif
        </article>

        <hr>
    @empty
        <p>Aucun avis pour cette recette.</p>
    @endforelse
</body>
</html>
