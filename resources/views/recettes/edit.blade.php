<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une recette</title>
</head>
<body>
    <h1>Modifier une recette</h1>

    <form method="post" action="{{ route('recettes.update', $recette) }}" enctype="multipart/form-data">
        @method('PATCH')
        @include('recettes._form')
    </form>

    @if ($recette->image_path)
        <form method="post" action="{{ route('recettes.image.destroy', $recette) }}">
            @csrf
            @method('DELETE')

            <button type="submit"
                onclick="return confirm('Voulez-vous vraiment supprimer cette image ?')">
                Supprimer l'image
            </button>
        </form>
    @endif

    <p>
        <a href="{{ route('recettes.show', $recette) }}">Annuler</a>
    </p>
</body>
</html>
