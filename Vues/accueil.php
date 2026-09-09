<?php ob_start(); ?>

<h1><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></h1>

<h2><?= htmlspecialchars($auteur, ENT_QUOTES, 'UTF-8') ?></h2>

<h3>Version PHP: <?= htmlspecialchars($versionPhp, ENT_QUOTES, 'UTF-8') ?></h3>

    <p>
        L'application permet de résoudre le problème de la difficulté
        à organiser des recettes et des menus. Les personnes qui utiliseront cette application seront toutes celles qui s'intéressent à la cuisine,
        comme les cuisiniers et les personnes qui souhaitent découvrir de nouvelles recettes et trouver des idées de recettes. 
    </p>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/gabarit.php';