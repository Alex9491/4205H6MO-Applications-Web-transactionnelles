<?php

declare(strict_types=1);

class ControleurAvis
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

    public function afficherFormulaire(int $idRecette,array $erreurs = [],array $valeurs = []): void
     {
        $recette = $this->recettes->obtenirParId($idRecette);

        if ($recette === null) {
            $this->erreurs->afficher('Recette introuvable.', 404);
            return;
        }

        $this->vue->afficher('avis/ajouter',[
                'recette' => $recette,
                'erreurs' => $erreurs,
                'valeurs' => $valeurs,
            ],'Ajouter un avis');
    }

    public function ajouter(array $donnees): void
    {
        $idRecette = filter_var(
            $donnees['idrecette'] ?? null,
            FILTER_VALIDATE_INT
        );

        $note = filter_var(
            $donnees['note'] ?? null,
            FILTER_VALIDATE_INT
        );

        $erreurs = [];

        if ($idRecette === false || $idRecette === null) {
            $this->erreurs->afficher('Identifiant invalide.', 400);
            return;
        }

        if ($this->recettes->obtenirParId($idRecette) === null) {
            $this->erreurs->afficher('Recette introuvable.', 404);
            return;
        }

        if ($note === false || $note === null) {
            $erreurs['note'] = 'La note est obligatoire.';
        } elseif ($note < 1 || $note > 5) {
            $erreurs['note'] = 'La note doit être un nombre entre 1 et 5.';
        }

        if ($erreurs !== []) {
            $this->afficherFormulaire($idRecette,$erreurs,[
                    'note' => $donnees['note'] ?? ''
                ]
            );
            return;
        }

        $this->avis->ajouter($idRecette, $note);
        header('Location: index.php?action=recette&id=' . $idRecette);
        exit;
    }

    public function confirmerSuppression(int $id): void
    {
        $avis = $this->avis->obtenirParId($id);

        if ($avis === null) {
            $this->erreurs->afficher('Avis introuvable.', 404);
            return;
        }

        $this->vue->afficher('avis/confirmer-suppression',[
                'avis' => $avis
            ],'Confirmer la suppression');
    }

    public function supprimer(int $id): void
    {
        $avis = $this->avis->obtenirParId($id);

        if ($avis === null) {
            $this->erreurs->afficher('Avis introuvable.', 404);
            return;
        }

        $this->avis->supprimer($id);
        header('Location: index.php?action=recette&id=' . $avis['idrecette']);
        exit;
    }
}