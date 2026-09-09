<?php

declare(strict_types=1);

function afficherRecettes(PDO $pdo): void
{
    $recettes = obtenirRecettes($pdo);
    $titrePage = 'Mes recettes';

    require __DIR__ . '/../Vues/recettes/index.php';
}