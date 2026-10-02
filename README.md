# Collection collaborative de recettes et de menus

Cette application web permet permet aux utilisateur de créer, regarder, partager, supprimer et ajouter leur avis sur des recettes et menus déja créées.

L'application permet de résoudre le problème de la difficulté à organiser des recettes et des menus.

## Prérequis

- AMPPS
- Apache
- PHP 8.2
- MySQL
- Git
- Un navigateur Web
- Xdebug

## Installation

1. Récupérer le dépôt.
2. Importer le fichier `database/mydb.sql` dans MySQL.
3. Exécuter ensuite le fichier `database/ajout-10-lignes.sql` dans MySQL.
4. Adapter la configuration locale sans versionner les secrets.

## Démarrage

Ajouter le bloc suivant dans le fichier de configuration Apache utilisé par AMPPS, en adaptant le chemin physique :

    Alias /projet "C:\ProjetWeb"

    <Directory "C:\ProjetWeb">
    Options -Indexes +FollowSymLinks
    AllowOverride All
    Require all granted
    </Directory>

Redémarrer ensuite Apache et démarrer MySQL dans AMPPS, puis ouvrir :

http://localhost/projet/


## Constructions

Aucune compilation n'est nécessaire pour cette version.


## Tests

Création d'un compte avec validation des données
Complété

Le mot de passe du compte est enregistré sous forme hachée
Complété

Connexion avec un compte valide
Complété

Connexion invalide refusée
Complété

Affichage du nom de l'utilisateur connecté dans le gabarit
Complété

Déconnexion
Complété

Formulaire de modification prérempli
Complété

Modification invalide refusée
Complété

Modification valide enregistrée
Complété

URL lisibles pour la liste, le détail et la modification
Complété

Ajouter un avis à une recette
Complété

Supprimer un avis après confirmation
Complété

Liste et détail des recettes fonctionnent
Complété

Un identifiant ou une action inconnue retourne une page 404
Complété

Le formulaire d'ajout d'un avis refuse les valeurs invalides et conserve les valeurs valides
Complété

Une soumission valide crée un avis et redirige vers la recette
Complété

La confirmation affiche l'avis sans le supprimer et Annuler retourne à la recette
Complété

La confirmation par POST supprime l'avis et redirige vers la recette
Complété

Une action d'écriture appelée avec GET retourne 405 et un jeton CSRF invalide retourne 403
Complété

Une actualisation après une redirection ne répète pas la création ou la suppression
Complété

## Configurations

La connexion à la base de données utilise PDO et les variables d'environnement `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD`.

L'application utilise une organisation orientée objet de type MVC. Les modèles héritent de `Modele`, les contrôleurs gèrent les actions et `Vue` centralise le rendu des pages.

Les principales routes disponibles sont `accueil`, `recettes`, `recette/{id}`, `recits`, `connexion` et `inscription`. Les actions de traitement comme `authentifier`, `inscrire` et `deconnexion` utilisent des requêtes POST.