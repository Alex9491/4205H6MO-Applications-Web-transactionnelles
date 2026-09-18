<?php ob_start(); ?>

<h1>Confirmer la suppression</h1>

<p>
    Voulez-vous supprimer cet avis ?
</p>

<p>
    <strong>Note :</strong>
    <?= htmlspecialchars((string) $avis['note'], ENT_QUOTES, 'UTF-8') ?>/5
</p>

<p>
    <strong>Date :</strong>
    <?= htmlspecialchars((string) $avis['dateavis'], ENT_QUOTES, 'UTF-8') ?>
</p>

<form action="index.php?action=supprimer-avis" method="post">
    <input type="hidden" name="jeton_csrf"
           value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <input type="hidden" name="id"
           value="<?= (int) $avis['idavis'] ?>">

    <button type="submit">Confirmer la suppression</button>

    <a href="index.php?action=recette&id=<?= (int) $avis['idrecette'] ?>">
        Annuler
    </a>
</form>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';