<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Avis extends Modele
{
    public function obtenirPourRecette(int $idRecette): array
    {
        return $this->executer(
            'SELECT idavis, idutilisateur, idrecette, note, dateavis
             FROM Avis
             WHERE idrecette = :idrecette
             ORDER BY dateavis DESC, idavis DESC',
            ['idrecette' => $idRecette]
        )->fetchAll();
    }

    public function obtenirParId(int $id): ?array
    {
        $avis = $this->executer(
            'SELECT idavis, idutilisateur, idrecette, note, dateavis
             FROM Avis
             WHERE idavis = :id',
            ['id' => $id]
        )->fetch();

        return $avis ?: null;
    }

    public function ajouter(int $idRecette, int $note): int
    {
        $this->executer(
            'INSERT INTO Avis (idrecette, note)
             VALUES (:idrecette, :note)',
            [
                'idrecette' => $idRecette,
                'note' => $note,
            ]
        );

        return (int) $this->pdo->lastInsertId();
    }

    public function supprimer(int $id): bool
    {
        $requete = $this->executer(
            'DELETE FROM Avis
             WHERE idavis = :id',
            ['id' => $id]
        );

        return $requete->rowCount() === 1;
    }
}