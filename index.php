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
    <p>
        L'application permet de résoudre le problème de la difficulté
        à organiser des recettes et des menus. Les personnes qui utiliseront cette application seront toutes celles qui s'intéressent à la cuisine,
        comme les cuisiniers et les personnes qui souhaitent découvrir de nouvelles recettes et trouver des idées de recettes. 
    </p>    
    <a href="recits.php">recits</a>
    <a href="">recettes</a>
    <a href="">menus</a>
    </div>
</body>
</html>