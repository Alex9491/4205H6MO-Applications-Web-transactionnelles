<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une recette</title>
</head>
<body>
    <h1>Créer une recette</h1>

    <form method="post" action="{{ route('recettes.store') }}">
        @include('recettes._form', ['recette' => null])
    </form>

    <p>
        <a href="{{ route('recettes.index') }}">Retour aux recettes</a>
    </p>
</body>
</html>
