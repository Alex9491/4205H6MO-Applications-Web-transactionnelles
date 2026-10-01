<!DOCTYPE html>
<html lang="fr">
<head>
    <?php $baseUrl = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/'; ?>
    <base href="<?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav>
    <a href="accueil">Accueil</a>
    <a href="recettes">Recettes</a>
    <a href="recits">Récits</a>
</nav>

    <main>
        <?= $contenu ?>
    </main>
</body>
</html>