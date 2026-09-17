<?php

declare(strict_types=1);

function obtenirRecettes(PDO $pdo): array
{
    $requete = $pdo->prepare(
        'SELECT idrecette, idutilisateur, idcategorie, nom, description
         FROM Recettes
         ORDER BY idrecette'
    );

    $requete->execute();

    return $requete->fetchAll();
}

function obtenirRecette(PDO $pdo, int $idRecette): ?array
{
    $requete = $pdo->prepare(
        'SELECT idrecette, idutilisateur, idcategorie, nom, description
         FROM Recettes
         WHERE idrecette = :idrecette'
    );

    $requete->execute([
        'idrecette' => $idRecette
    ]);

    $recette = $requete->fetch();

    return $recette ?: null;
}