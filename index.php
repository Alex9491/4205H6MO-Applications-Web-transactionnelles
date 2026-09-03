<?php
$nomProjet = 'Recette';
$auteur = 'Alex Boyajian';
$versionPhp = PHP_VERSION;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($nomProjet)?></title>
</head>
<body>
    <div>
        <h1>
            <?= htmlspecialchars($nomProjet)?>
        </h1>
        <h2>
            <?= htmlspecialchars($auteur)?>
        </h2>
        <h3>
            Version PHP: <?= htmlspecialchars($versionPhp)?>
        </h3>
    </div>
    <a href="recits.php">recits</a>
</body>
</html>