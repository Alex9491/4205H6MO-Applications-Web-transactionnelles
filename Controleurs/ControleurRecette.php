<?php

declare(strict_types=1);

class ControleurRecette
{
    private $recettes;
    private $avis;
    private $vue;
    private $erreurs;

    public function __construct(
        Recette $recettes,
        Avis $avis,
        Vue $vue,
        ControleurErreur $erreurs
    ) {
        $this->recettes = $recettes;
        $this->avis = $avis;
        $this->vue = $vue;
        $this->erreurs = $erreurs;
    }

    public function index(): void
    {
        $this->vue->afficher('recettes/index',[
                'recettes' => $this->recettes->obtenirTous(),
            ], 'Mes recettes');
    }

    public function afficher(int $id): void
    {
        $recette = $this->recettes->obtenirParId($id);

        if ($recette === null) {
            $this->erreurs->afficher('Recette introuvable.', 404);
            return;
        }

        $this->vue->afficher('recettes/afficher',[
                'recette' => $recette,
                'avis' => $this->avis->obtenirPourRecette($id),
            ], $recette['nom']);
    }

    public function afficherModification(
    int $id,
    array $erreurs = [],
    array $valeurs = []
): void {
    $recette = $this->recettes->obtenirParId($id);

    if ($recette === null) {
        $this->erreurs->afficher('Recette introuvable.', 404);
        return;
    }

    if ($valeurs === []) {
        $valeurs = [
            'nom' => $recette['nom'],
            'description' => $recette['description'],
        ];
    }

    $this->vue->afficher(
        'recettes/modifier',
        [
            'recette' => $recette,
            'erreurs' => $erreurs,
            'valeurs' => $valeurs,
        ],
        'Modifier une recette'
    );
}

public function modifier(int $id, array $donnees): void
{
    $nom = trim($donnees['nom'] ?? '');
    $description = trim($donnees['description'] ?? '');

    $erreurs = [];

    if ($nom === '') {
        $erreurs['nom'] = 'Le nom est obligatoire.';
    }

    if ($description === '') {
        $erreurs['description'] = 'La description est obligatoire.';
    }

    if ($erreurs !== []) {
        $this->afficherModification(
            $id,
            $erreurs,
            [
                'nom' => $nom,
                'description' => $description,
            ]
        );
        return;
    }

$this->recettes->modifier($id, $nom, $description);

header('Location: /projet/recette/' . $id);
exit;
}
}