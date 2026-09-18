<?php

declare(strict_types=1);

require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/Modeles/recette-modele.php';
require_once __DIR__ . '/Modeles/avis-modele.php';
require_once __DIR__ . '/Controleurs/accueil-controleur.php';
require_once __DIR__ . '/Controleurs/recette-controleur.php';
require_once __DIR__ . '/Controleurs/erreur-controleur.php';

demarrerSession();

$action = $_GET['action'] ?? 'recettes';

try {
    require_once __DIR__ . '/config/bdd.php';

    switch ($action) {
        case 'accueil':
            afficherAccueil();
            break;

        case 'recettes':
            afficherRecettes($pdo);
            break;

        case 'recette':
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            afficherRecette($pdo, $id);
            break;

        default:
            afficherErreur('Page introuvable.', 404);
    }
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    afficherErreur('Une erreur empêche le traitement de la demande.', 500);
}