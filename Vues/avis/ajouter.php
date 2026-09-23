<?php

declare(strict_types=1);
?>

<?php $premierChampErreur = array_key_first($erreurs); ?>

<h1>Ajouter un avis</h1>

<p>
    Recette :
    <?= htmlspecialchars($recette['nom'], ENT_QUOTES, 'UTF-8') ?>
</p>

<?php if ($erreurs !== []): ?>
    <div id="resume-erreurs" role="alert">
        <h2>Le formulaire contient des erreurs</h2>
        <ul>
        <?php foreach ($erreurs as $erreur): ?>
            <li><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="index.php?action=avis-ajouter" method="post">

    <input type="hidden" name="jeton_csrf"
           value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>">

    <input type="hidden" name="idrecette"
           value="<?= (int) $recette['idrecette'] ?>">

    <label for="note">Note</label>

    <input id="note" name="note" type="number" min="1" max="5" required
           <?= isset($erreurs['note']) ? 'aria-invalid="true" aria-describedby="erreur-note"' : '' ?>
           <?= $premierChampErreur === 'note' ? 'autofocus' : '' ?>
           value="<?= htmlspecialchars((string) ($valeurs['note'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">

    <?php if (isset($erreurs['note'])): ?>
        <p id="erreur-note">
            <?= htmlspecialchars($erreurs['note'], ENT_QUOTES, 'UTF-8') ?>
        </p>
    <?php endif; ?>

    <button type="submit">Ajouter</button>

    <a href="index.php?action=recette&id=<?= (int) $recette['idrecette'] ?>">
        Annuler
    </a>

</form>