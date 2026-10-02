<?php

declare(strict_types=1);

class ControleurUtilisateur
{
    private $utilisateurs;
    private $authentification;
    private $vue;

    public function __construct(
        Utilisateur $utilisateurs,
        Authentification $authentification,
        Vue $vue
    ) {
        $this->utilisateurs = $utilisateurs;
        $this->authentification = $authentification;
        $this->vue = $vue;
    }

    public function connexion(?string $erreur = null,string $identifiant = ''): void 
    {
        if ($this->authentification->utilisateur() !== null) {
        header('Location: accueil');
        exit;
        }

        $this->vue->afficher(
            'utilisateurs/connexion',
            compact('erreur', 'identifiant'),
            'Connexion'
        );
    }

    public function inscription(
    array $erreurs = [],
    string $nom = '',
    string $courriel = ''
): void {
    if ($this->authentification->utilisateur() !== null) {
        header('Location: accueil');
        exit;
    }

    $this->vue->afficher(
        'utilisateurs/inscription',
        compact('erreurs', 'nom', 'courriel'),
        'Créer un compte'
    );
}

public function inscrire(array $donnees): void
{
    $nom = trim($donnees['nom'] ?? '');
    $courriel = trim($donnees['courriel'] ?? '');
    $motDePasse = $donnees['mot_de_passe'] ?? '';
    $confirmation = $donnees['confirmation'] ?? '';

    if ($nom === '') {
        $this->inscription(['nom' => 'Le nom est obligatoire.'], $nom, $courriel);
        return;
    }

    if ($courriel === '') {
        $this->inscription(['courriel' => 'Le courriel est obligatoire.'], $nom, $courriel);
        return;
    }

    if ($motDePasse === '') {
        $this->inscription(['mot_de_passe' => 'Le mot de passe est obligatoire.'], $nom, $courriel);
        return;
    }

    if (!filter_var($courriel, FILTER_VALIDATE_EMAIL)) {
        $this->inscription(['courriel' => 'Le courriel est invalide.'], $nom, $courriel);
        return;
    }

    if ($motDePasse !== $confirmation) {
        $this->inscription(['confirmation' => 'Les mots de passe ne correspondent pas.'], $nom, $courriel);
        return;
    }

    if ($this->utilisateurs->trouverParIdentifiant($courriel) !== null) {
        $this->inscription(['courriel' => 'Ce courriel est déjà utilisé.'], $nom, $courriel);
        return;
    }

try {
    $this->utilisateurs->ajouter($nom, $courriel, $motDePasse);
} catch (Throwable $e) {
    die($e->getMessage());
}

header('Location: connexion');
exit;
}

    public function authentifier(array $donnees): void
    {
        $identifiant = trim((string) ($donnees['identifiant'] ?? ''));
        $motDePasse = (string) ($donnees['mot_de_passe'] ?? '');
        $utilisateur = $this->utilisateurs->trouverParIdentifiant($identifiant);

        if ($utilisateur === null
            || !password_verify($motDePasse,$utilisateur['motdepasse'])) 
            {
            $this->connexion('Identifiant ou mot de passe invalide.',$identifiant);
            return;
        }

        $this->authentification->connecter($utilisateur);
        header('Location: recettes');
        exit;
    }

    public function deconnecter(): void
    {
        $this->authentification->deconnecter();
        header('Location: recettes');
        exit;
    }
}