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
}