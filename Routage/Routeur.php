<?php

declare(strict_types=1);

class Routeur
{
    private $controleurRecette;
    private $controleurAvis;
    private $controleurErreur;
    private $controleurUtilisateur;
    private $controleurAccueil;
    private $controleurRecits;

    public function __construct(
        ControleurRecette $controleurRecette,
        ControleurAvis $controleurAvis,
        ControleurErreur $controleurErreur,
        ControleurUtilisateur $controleurUtilisateur,
        ControleurAccueil $controleurAccueil,
        ControleurRecits $controleurRecits
    ) {
        $this->controleurRecette = $controleurRecette;
        $this->controleurAvis = $controleurAvis;
        $this->controleurErreur = $controleurErreur;
        $this->controleurUtilisateur = $controleurUtilisateur;
        $this->controleurAccueil = $controleurAccueil;
        $this->controleurRecits = $controleurRecits;
    }

    public function router(): void
    {
        $action = $_GET['action'] ?? 'recettes';

        switch ($action) {

            case 'accueil':
                $this->controleurAccueil->index();
                break;

            case 'recettes':
                $this->controleurRecette->index();
                break;

            case 'recette':
                $this->controleurRecette->afficher($this->lireIdGet());
                break;

            case 'recits':
                $this->controleurRecits->index();
                break;

            case 'connexion':
                $this->controleurUtilisateur->connexion();
                break;

            case 'authentifier':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurUtilisateur->authentifier($_POST);
                break;

            case 'deconnexion':
                $this->exigerEcriture($_POST['jeton_csrf'] ?? null);
                $this->controleurUtilisateur->deconnecter();
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