<?php

declare(strict_types=1);

function afficherRecettes(PDO $pdo): array
{
    $requete = $pdo->prepare(
        'SELECT idrecette, idutilisateur, idcategorie, nom, description
         FROM Recettes
         ORDER BY idrecette'
    );

    $requete->execute();

    return $requete->fetchAll();
}