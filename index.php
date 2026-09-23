<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bdd.php';
require_once __DIR__ . '/config/securite.php';
require_once __DIR__ . '/Modeles/Modele.php';
require_once __DIR__ . '/Modeles/Recette.php';
require_once __DIR__ . '/Modeles/Avis.php';
require_once __DIR__ . '/Vues/Vue.php';
require_once __DIR__ . '/Controleurs/ControleurRecette.php';
require_once __DIR__ . '/Controleurs/ControleurAvis.php';
require_once __DIR__ . '/Controleurs/ControleurErreur.php';
require_once __DIR__ . '/Routage/Routeur.php';

demarrerSession();

$recettes = new Recette($pdo);
$avis = new Avis($pdo);
$vue = new Vue();
$controleurErreur = new ControleurErreur($vue);
$controleurRecette = new ControleurRecette($recettes,$avis,$vue,$controleurErreur);
$controleurAvis = new ControleurAvis($recettes,$avis,$vue,$controleurErreur);
$routeur = new Routeur($controleurRecette,$controleurAvis,$controleurErreur);

try {
    $routeur->router();
} catch (Throwable $exception) {
    $statut = in_array($exception->getCode(), [400, 403, 404, 405], true)
        ? $exception->getCode()
        : 500;
    $message = $statut === 500
        ? 'Une erreur empêche le traitement de la demande.'
        : $exception->getMessage();

    if ($statut === 500) {
        error_log($exception->getMessage());
    }

    $controleurErreur->afficher($message, $statut);
}