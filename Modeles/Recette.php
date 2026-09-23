<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Recette extends Modele
{
    public function obtenirTous(): array
    {
        return $this->executer(
            'SELECT idrecette, idutilisateur, idcategorie, nom, description
             FROM Recettes
             ORDER BY idrecette'
        )->fetchAll();
    }

    public function obtenirParId(int $id): ?array
    {
        $recette = $this->executer(
            'SELECT idrecette, idutilisateur, idcategorie, nom, description
             FROM Recettes
             WHERE idrecette = :idrecette',
            ['idrecette' => $id]
        )->fetch();

        return $recette ?: null;
    }
}