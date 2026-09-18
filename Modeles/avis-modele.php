<?php

declare(strict_types=1);

function obtenirAvisRecette(PDO $pdo, int $idRecette): array
{
    $requete = $pdo->prepare(
        'SELECT idavis, idutilisateur, idrecette, note, dateavis
         FROM Avis
         WHERE idrecette = :idrecette
         ORDER BY dateavis DESC, idavis DESC'
    );

    $requete->execute([
        'idrecette' => $idRecette
    ]);

    return $requete->fetchAll();
}

function ajouterAvis(PDO $pdo, int $idRecette, int $note): int
{
    $requete = $pdo->prepare(
        'INSERT INTO Avis (idrecette, note)
         VALUES (:idrecette, :note)'
    );

    $requete->execute([
        'idrecette' => $idRecette,
        'note' => $note,
    ]);

    return (int) $pdo->lastInsertId();
}

function obtenirAvis(PDO $pdo, int $id): ?array
{
    $requete = $pdo->prepare(
        'SELECT idavis, idutilisateur, idrecette, note, dateavis
         FROM Avis
         WHERE idavis = :id'
    );

    $requete->execute([
        'id' => $id
    ]);

    $avis = $requete->fetch();

    return $avis ?: null;
}

function supprimerAvis(PDO $pdo, int $id): bool
{
    $requete = $pdo->prepare(
        'DELETE FROM Avis
         WHERE idavis = :id'
    );

    $requete->execute([
        'id' => $id
    ]);

    return $requete->rowCount() === 1;
}