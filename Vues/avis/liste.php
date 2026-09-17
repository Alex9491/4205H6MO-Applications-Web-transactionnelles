<section>
    <h2>Avis</h2>

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
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>