<?php

declare(strict_types=1);

function afficherRecettes(PDO $pdo): void
{
    $recettes = obtenirRecettes($pdo);
    $titrePage = 'Mes recettes';

    require __DIR__ . '/../Vues/recettes/index.php';
}

function afficherRecette(PDO $pdo, int $idRecette): void
{
    $recette = obtenirRecette($pdo, $idRecette);

    if ($recette === null) {
        afficherErreur('Recette introuvable.', 404);
        return;
    }

    $avis = obtenirAvisRecette($pdo, $idRecette);
    $titrePage = $recette['nom'];

    require __DIR__ . '/../Vues/recettes/afficher.php';
}