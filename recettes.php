<?php

declare(strict_types=1);

try {
    require_once __DIR__ . '/config/bdd.php';
    require_once __DIR__ . '/Modeles/recette-modele.php';
    require_once __DIR__ . '/Controleurs/recette-controleur.php';

    afficherRecettes($pdo);
} catch (Throwable $exception) {
    error_log($exception->getMessage());

    $titrePage = 'Erreur';
    $messageErreur = 'Impossible de charger les recettes.';
    require __DIR__ . '/Vues/erreur.php';
}