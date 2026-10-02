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

    public function ajouter(string $nom,string $courriel,string $motDePasse): int {
    $hachage = password_hash($motDePasse, PASSWORD_DEFAULT);

    $this->executer(
        'INSERT INTO Utilisateurs (nom, courriel, motdepasse)
         VALUES (:nom, :courriel, :motdepasse)',
        [
            'nom' => $nom,
            'courriel' => $courriel,
            'motdepasse' => $hachage,
        ]
    );

    return (int) $this->pdo->lastInsertId();
}
}