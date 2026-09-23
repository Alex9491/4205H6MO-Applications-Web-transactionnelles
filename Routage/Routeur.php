<?php

declare(strict_types=1);

class Routeur
{
    private $controleurRecette;
    private $controleurAvis;
    private $controleurErreur;

    public function __construct(
        ControleurRecette $controleurRecette,
        ControleurAvis $controleurAvis,
        ControleurErreur $controleurErreur
    ) {
        $this->controleurRecette = $controleurRecette;
        $this->controleurAvis = $controleurAvis;
        $this->controleurErreur = $controleurErreur;
    }

    public function router(): void
    {
        $action = $_GET['action'] ?? 'recettes';

        switch ($action) {
            case 'recettes':
                $this->controleurRecette->index();
                break;

            case 'recette':
                $this->controleurRecette->afficher($this->lireIdGet());
                break;

            case 'avis-formulaire':
                $this->controleurAvis->afficherFormulaire($this->lireIdGet());
                break;

            case 'avis-ajouter':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurAvis->ajouter($_POST);
                break;

            case 'confirmer-suppression-avis':
                $this->controleurAvis->confirmerSuppression($this->lireIdGet());
                break;

            case 'supprimer-avis':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurAvis->supprimer($this->lireIdPost());
                break;

            default:
                $this->controleurErreur->afficher('Page introuvable.',404);
        }
    }

    private function lireIdGet(): int
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {
            throw new InvalidArgumentException('Identifiant invalide.',400);
        }

        return $id;
    }

    private function lireIdPost(): int
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        if ($id === false || $id === null) {throw new InvalidArgumentException('Identifiant invalide.',400);
        }

        return $id;
    }

    private function exigerEcriture($jeton): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {throw new RuntimeException('Méthode non permise.',405);
        }

        if (!verifierJetonCsrf($jeton)) {throw new RuntimeException('Requête refusée.',403);
        }
    }
}