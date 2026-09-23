<?php

declare(strict_types=1);
?>

<h1><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></h1>

<?php if ($recettes === []): ?>
    <p>Aucune recette n'est disponible.</p>
<?php else: ?>
    <?php foreach ($recettes as $recette): ?>
        <article>
            <h2>
                <a href="recette/<?= (int) $recette['idrecette'] ?>">
                    <?= htmlspecialchars($recette['nom'], ENT_QUOTES, 'UTF-8') ?>
                </a>
            </h2>
            <p>
                <?= htmlspecialchars($recette['description'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        </article>
    <?php endforeach; ?>
<?php endif; ?>