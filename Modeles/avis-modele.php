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