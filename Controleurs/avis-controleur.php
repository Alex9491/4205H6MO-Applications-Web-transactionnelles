<?php

declare(strict_types=1);

function afficherFormulaireAvis(
    PDO $pdo,
    int $idRecette,
    array $erreurs = [],
    array $valeurs = []
): void {
    $recette = obtenirRecette($pdo, $idRecette);

    if ($recette === null) {
        afficherErreur('Recette introuvable.', 404);
        return;
    }

    $titrePage = 'Ajouter un avis';
    require __DIR__ . '/../Vues/avis/ajouter.php';
}

function ajouterAvisAction(PDO $pdo): void
{
    $idRecette = filter_input(INPUT_POST, 'idrecette', FILTER_VALIDATE_INT);
    $note = filter_input(INPUT_POST, 'note', FILTER_VALIDATE_INT);
    $erreurs = [];

    if ($idRecette === false || $idRecette === null) {
        afficherErreur('Identifiant invalide.', 400);
        return;
    }

    if (obtenirRecette($pdo, $idRecette) === null) {
        afficherErreur('Recette introuvable.', 404);
        return;
    }

    if ($note === false || $note === null) {
        $erreurs['note'] = 'La note est obligatoire.';
    } elseif ($note < 1 || $note > 5) {
        $erreurs['note'] = 'La note doit être un nombre entre 1 et 5.';
    }

    if ($erreurs !== []) {
        afficherFormulaireAvis($pdo, $idRecette, $erreurs, [
            'note' => $note,
        ]);
        return;
    }

    ajouterAvis($pdo, $idRecette, $note);
    header('Location: index.php?action=recette&id=' . $idRecette);
    exit;
}

function confirmerSuppressionAvis(PDO $pdo, int $id): void
{
    $avis = obtenirAvis($pdo, $id);

    if ($avis === null) {
        afficherErreur('Avis introuvable.', 404);
        return;
    }

    $titrePage = 'Confirmer la suppression';
    require __DIR__ . '/../Vues/avis/confirmer-suppression.php';
}

function supprimerAvisAction(PDO $pdo, int $id): void
{
    $avis = obtenirAvis($pdo, $id);

    if ($avis === null) {
        afficherErreur('Avis introuvable.', 404);
        return;
    }

    supprimerAvis($pdo, $id);
    header('Location: index.php?action=recette&id=' . $avis['idrecette']);
    exit;
}