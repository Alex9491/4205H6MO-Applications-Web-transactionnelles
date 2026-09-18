<?php ob_start(); ?>

<h1>Ajouter un avis</h1>

<p>
    Recette :
    <?= htmlspecialchars($recette['nom'], ENT_QUOTES, 'UTF-8') ?>
</p>

<form action="index.php?action=avis-ajouter" method="post">

    <input type="hidden" name="jeton_csrf"
           value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <input type="hidden" name="idrecette"
           value="<?= (int) $recette['idrecette'] ?>">

    <label for="note">Note</label>
    <input id="note" name="note" type="number" min="1" max="5" required>

    <button type="submit">Ajouter</button>

    <a href="index.php?action=recette&id=<?= (int) $recette['idrecette'] ?>">
        Annuler
    </a>

</form>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/../gabarit.php';