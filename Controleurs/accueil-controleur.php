<?php

declare(strict_types=1);

function afficherAccueil(): void
{
    $titrePage = 'Collaboration de recettes et de menu';
    $auteur = 'Alex Boyajian';
    $versionPhp = PHP_VERSION;

    require __DIR__ . '/../Vues/accueil.php';
}