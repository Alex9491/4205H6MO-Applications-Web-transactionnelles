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

    <?php if ($utilisateurCourant !== null): ?>
        <span>
            Utilisateur: <?= htmlspecialchars($utilisateurCourant['nom'], ENT_QUOTES, 'UTF-8') ?>
        </span>

        <form action="index.php?action=deconnexion" method="post" style="display:inline;">
            <input type="hidden" name="jeton_csrf"value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">
            <button type="submit">Déconnexion</button>
        </form>
    <?php else: ?>
        <a href="connexion">Connexion</a>
        <a href="inscription">Créer un compte</a>
    <?php endif; ?>
    </nav>

    <main>
        <?= $contenu ?>
    </main>
</body>
</html>