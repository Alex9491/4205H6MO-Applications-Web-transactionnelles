<?php ob_start(); ?>

<h1><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></h1>

<?php if ($recettes === []): ?>
    <p>Aucune recette n'est disponible.</p>
<?php else: ?>
    <?php foreach ($recettes as $recette): ?>
        <article>
            <h2><?= htmlspecialchars($recette['nom'], ENT_QUOTES, 'UTF-8') ?></h2>

            <p>
                <?= htmlspecialchars($recette['description'], ENT_QUOTES, 'UTF-8') ?>
            </p>
        </article>
    <?php endforeach; ?>
<?php endif; ?>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';