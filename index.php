<?php

declare(strict_types=1);

require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/Modeles/recette-modele.php';
require_once __DIR__ . '/Modeles/avis-modele.php';
require_once __DIR__ . '/Controleurs/accueil-controleur.php';
require_once __DIR__ . '/Controleurs/recits-controleur.php';
require_once __DIR__ . '/Controleurs/recette-controleur.php';
require_once __DIR__ . '/Controleurs/avis-controleur.php';
require_once __DIR__ . '/Controleurs/erreur-controleur.php';

demarrerSession();

$action = $_GET['action'] ?? 'accueil';

try {
    require_once __DIR__ . '/config/bdd.php';

    switch ($action) {
        case 'accueil':
            afficherAccueil();
            break;
            
        case 'recits':
            afficherRecits();
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

        case 'avis-formulaire':
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            afficherFormulaireAvis($pdo, $id);
            break;

        case 'avis-ajouter':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                afficherErreur('Méthode non permise.', 405);
                break;
            }

            if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
                afficherErreur('Requête refusée.', 403);
                break;
            }

            ajouterAvisAction($pdo);
            break;

        case 'confirmer-suppression-avis':
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            confirmerSuppressionAvis($pdo, $id);
            break;

        case 'supprimer-avis':
            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                afficherErreur('Méthode non permise.', 405);
                break;
            }

            if (!verifierJetonCsrf($_POST['jeton_csrf'] ?? null)) {
                afficherErreur('Requête refusée.', 403);
                break;
            }

            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null) {
                afficherErreur('Identifiant invalide.', 400);
                break;
            }

            supprimerAvisAction($pdo, $id);
            break;

        default:
            afficherErreur('Page introuvable.', 404);
    }
} catch (Throwable $exception) {
    error_log($exception->getMessage());
    afficherErreur('Une erreur empêche le traitement de la demande.', 500);
}