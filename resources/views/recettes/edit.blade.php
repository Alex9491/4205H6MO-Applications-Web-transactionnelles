<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une recette</title>
</head>
<body>
    <h1>Modifier une recette</h1>

    <form method="post" action="{{ route('recettes.update', $recette) }}">
        @method('PATCH')
        @include('recettes._form')
    </form>

    <p>
        <a href="{{ route('recettes.show', $recette) }}">Annuler</a>
    </p>
</body>
</html>
