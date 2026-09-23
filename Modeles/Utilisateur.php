<?php

declare(strict_types=1);

require_once __DIR__ . '/Modele.php';

class Utilisateur extends Modele
{
    public function trouverParIdentifiant(string $identifiant): ?array
    {
        $utilisateur = $this->executer(
            'SELECT idUtilisateurs, nom, courriel, motdepasse
             FROM Utilisateurs
             WHERE courriel = :identifiant',
            ['identifiant' => $identifiant]
        )->fetch();

        return $utilisateur ?: null;
    }
}