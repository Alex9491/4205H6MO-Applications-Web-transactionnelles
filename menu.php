<?php
$nomTitre = 'Menu';
$auteur = 'Alex Boyajian';
$versionPhp = PHP_VERSION;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($nomTitre)?></title>
</head>
<body>
    <div>
        <h1>
            <?= htmlspecialchars($nomTitre)?>
        </h1>
        <h2>
            <?= htmlspecialchars($auteur)?>
        </h2>
        <h3>
            Version PHP: <?= htmlspecialchars($versionPhp)?>
        </h3>
    </div>
</body>
</html>