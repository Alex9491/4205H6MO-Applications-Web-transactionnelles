<?php

declare(strict_types=1);
?>

<h1>Modifier une recette</h1>

<?php if (!empty($erreurs)): ?>
    <div role="alert">
        <p>Veuillez corriger les erreurs suivantes :</p>

        <ul>
            <?php foreach ($erreurs as $erreur): ?>
                <li><?= htmlspecialchars($erreur, ENT_QUOTES, 'UTF-8') ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="modifier-recette/<?= (int) $recette['idrecette'] ?>" method="post">

    <input
        type="hidden"
        name="jeton_csrf"
        value="<?= htmlspecialchars(jetonCsrf(), ENT_QUOTES, 'UTF-8') ?>"
    >

    <label for="nom">Nom</label>

    <input
        id="nom"
        name="nom"
        value="<?= htmlspecialchars($valeurs['nom'], ENT_QUOTES, 'UTF-8') ?>"
        required
    >

    <label for="description">Description</label>

    <textarea
        id="description"
        name="description"
        required
    ><?= htmlspecialchars($valeurs['description'], ENT_QUOTES, 'UTF-8') ?></textarea>

    <button type="submit">Enregistrer</button>

</form>

<p>
    <a href="recette/<?= (int) $recette['idrecette'] ?>">
        Annuler
    </a>
</p>