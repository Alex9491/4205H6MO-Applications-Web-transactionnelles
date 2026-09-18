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

-Ajouter un avis à une recette
Complété
-Supprimer un avis après confirmation
Complété

## Configurations

La connexion à la base de données utilise PDO et les variables d'environnement `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME` et `DB_PASSWORD`.