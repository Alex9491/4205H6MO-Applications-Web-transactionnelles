<section>
    <h2>Avis</h2>
    <p>
        <a href="avis-formulaire/<?= (int) $recette['idrecette'] ?>">
            Ajouter un avis
        </a>
    </p>

    <?php if ($avis === []): ?>
        <p>Aucun avis pour cette recette.</p>
    <?php else: ?>
        <?php foreach ($avis as $Avis): ?>
            <article>
                <p>
                    Note :
                    <?= htmlspecialchars((string) $Avis['note'], ENT_QUOTES, 'UTF-8') ?>/5
                </p>

                <p>
                    Date :
                    <?= htmlspecialchars((string) $Avis['dateavis'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    <a href="confirmer-suppression-avis/<?= (int) $Avis['idavis'] ?>">
                        Supprimer
                    </a>
                </p>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>