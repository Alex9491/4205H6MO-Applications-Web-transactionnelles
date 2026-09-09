<?php ob_start(); ?>

<h1><?= htmlspecialchars($titrePage, ENT_QUOTES, 'UTF-8') ?></h1>

<p>Pages Recits</p>

<?php
$contenu = ob_get_clean();
require __DIR__ . '/gabarit.php';