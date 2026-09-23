<?php

declare(strict_types=1);
?>

<p>
    <a href="index.php?action=recettes">Retour aux recettes</a>
</p>

<article>
    <h1><?= htmlspecialchars($recette['nom'], ENT_QUOTES, 'UTF-8') ?></h1>

    <p>
        <?= htmlspecialchars($recette['description'], ENT_QUOTES, 'UTF-8') ?>
    </p>
</article>

<?php require __DIR__ . '/../avis/liste.php'; ?>
