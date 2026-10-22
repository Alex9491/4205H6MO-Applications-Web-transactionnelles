# Collection collaborative de recettes et de menus

Cette application web permet aux utilisateurs de créer, consulter et gérer des recettes et des menus, ainsi que d'ajouter des avis et des favoris.

Cette version utilise Laravel 12, PHP 8.2, Apache et MySQL avec Docker.

## Prérequis

- Docker Desktop
- Git
- Un navigateur Web

## Installation

1. Récupérer le dépôt :

    bash

    git clone <URL_DU_DEPOT>

    cd ProjetWeb

2. Copier le fichier d'environnement :

    bash

    cp .env.example .env

    Sous PowerShell :

    powershell

    Copy-Item .env.example .env

3. Vérifier la configuration Docker :

    powershell

    docker compose config --quiet

4. Construire et démarrer l'application :

    powershell

    docker compose up --build -d

5. Installer les dépendances PHP :

    powershell

    docker compose exec app composer install

6. Générer la clé Laravel :

    powershell

    docker compose exec app php artisan key:generate

7. Créer les tables de la base de données :

    powershell

    docker compose exec app php artisan migrate

8. Charger les données de démonstration :

    powershell

    docker compose exec app php artisan db:seed

## Démarrage

Une fois les conteneurs démarrés, l'application est accessible à l'adresse suivante :

[http://localhost:8080](http://localhost:8080)

Pour vérifier l'état des conteneurs :

powershell

docker compose ps

Pour vérifier l'état des migrations :

powershell

docker compose exec app php artisan migrate:status

## Base de données

La base de données MySQL est exécutée dans un conteneur Docker.

Les migrations Laravel créent les tables du domaine :

- Utilisateurs
- Categories
- Recettes
- Menus
- Menu_Recettes
- Favoris
- Avis

Les données MySQL sont conservées dans le volume Docker `laravel_mysql_data`.

La base de données du projet est créée à partir des migrations Laravel. Le fichier SQL de l'ancienne version PHP n'est pas utilisé pour créer la base Laravel.

## Configuration

Les paramètres de connexion à MySQL sont définis dans `.env` à partir de `.env.example`.

Les informations sensibles et le fichier `.env` ne doivent pas être versionnés.

## Tests des migrations

Pour recréer complètement la base de données à partir des migrations :

powershell

docker compose exec app php artisan migrate:fresh

Pour vérifier les migrations :

powershell

docker compose exec app php artisan migrate:status

**Attention :** la commande `migrate:fresh` supprime les tables existantes. Ne l'exécute pas si tu veux conserver tes données.

## Récits utilisateurs

### 1. Créer un compte

En tant que guest, je veux être capable de créer un compte.

Critères d'acceptation :

- Une personne ne peut pas s'inscrire 2 fois avec le même courriel.
- Si l'inscription réussit, un message de réussite est affiché et l'utilisateur est redirigé vers la page de connexion.
- Si l'inscription échoue, un message d'erreur est affiché et l'utilisateur n'est pas redirigé vers la page de connexion.

### 2. Se connecter

En tant que guest, je veux me connecter sur le site.

Critères d'acceptation :

- La connexion est refusée si le courriel ou le mot de passe est incorrect.
- Si le courriel et le mot de passe sont corrects, l'utilisateur est redirigé vers l'écran d'accueil.
- Un message d'erreur est affiché lorsque les informations sont incorrectes.

### 3. Rechercher une recette

En tant que user/guest, je veux rechercher une recette.

Critères d'acceptation :

- Le site redirige l'utilisateur vers la page de la recette si elle est trouvée.
- Le site redirige l'utilisateur vers une page d'erreur si la recette n'est pas trouvée.
- La recherche permet de trouver une recette à partir de son nom.

### 4. Rechercher un menu

En tant que user/guest, je veux rechercher un menu.

Critères d'acceptation :

- Le site redirige l'utilisateur vers la page du menu si celui-ci est trouvé.
- Le site redirige l'utilisateur vers une page d'erreur si le menu n'est pas trouvé.
- La recherche permet de trouver un menu à partir de son nom.

### 5. Créer une recette

**Statut : Complété**

En tant que user, je veux créer une recette.

Critères d'acceptation :

- Le nom de la recette est obligatoire.
- La recette est enregistrée dans la base de données.
- La nouvelle recette apparaît dans la liste des recettes.

### 6. Modifier une recette

**Statut : Complété**

En tant que user, je veux modifier une recette.

Critères d'acceptation :

- L'utilisateur peut modifier les informations de sa recette.
- Les modifications sont enregistrées dans la base de données.
- La recette affiche les nouvelles informations après la modification.

**### 7. Supprimer une recette**

**Statut : Complété**

En tant que user, je veux supprimer une recette.

Critères d'acceptation :

- La recette est supprimée de la base de données.
- Les avis associés sont supprimés avant la recette.
- La suppression fonctionne sans erreur de contrainte de clé étrangère.
- La recette supprimée n'apparaît plus dans la liste des recettes.

### 8. Créer un menu

En tant que user, je veux créer un menu.

Critères d'acceptation :

- Le nom du menu est obligatoire.
- Le menu est enregistré dans la base de données.
- Le nouveau menu apparaît dans la liste des menus.

### 9. Modifier un menu

En tant que user, je veux modifier un menu.

Critères d'acceptation :

- L'utilisateur peut modifier les informations de son menu.
- Les modifications sont enregistrées dans la base de données.
- Le menu affiche les nouvelles informations après la modification.

### 10. Supprimer un menu

En tant que user, je veux supprimer un menu.

Critères d'acceptation :

- L'utilisateur doit confirmer la suppression du menu.
- Le menu est supprimé de la base de données.
- Le menu supprimé n'apparaît plus dans la liste des menus.

### 11. Ajouter une recette à un menu

En tant que user, je veux ajouter une recette à un menu.

Critères d'acceptation :

- L'utilisateur peut sélectionner une recette existante.
- La recette est ajoutée au menu sélectionné.
- Une même recette ne peut pas être ajoutée 2 fois au même menu.

### 12. Ajouter un avis sur une recette

En tant que user, je veux ajouter un avis sur une recette.

Critères d'acceptation :

- L'utilisateur doit être connecté pour ajouter un avis.
- L'avis est enregistré dans la base de données.
- L'avis apparaît sur la page de la recette.

### 13. Ajouter un avis sur un menu

En tant que user, je veux ajouter un avis sur un menu.

Critères d'acceptation :

- L'utilisateur doit être connecté pour ajouter un avis.
- L'avis est enregistré dans la base de données.
- L'avis apparaît sur la page du menu.

### 14. Ajouter une recette aux favoris

En tant que user, je veux ajouter une recette aux favoris.

Critères d'acceptation :

- L'utilisateur doit être connecté pour ajouter une recette aux favoris.
- La recette apparaît dans la liste des favoris de l'utilisateur.
- Une même recette ne peut pas être ajoutée 2 fois aux favoris.

### 15. Ajouter un menu aux favoris

En tant que user, je veux ajouter un menu aux favoris.

Critères d'acceptation :

- L'utilisateur doit être connecté pour ajouter un menu aux favoris.
- Le menu apparaît dans la liste des favoris de l'utilisateur.
- Un même menu ne peut pas être ajouté 2 fois aux favoris.

### 16. Supprimer un utilisateur

En tant que admin, je veux être capable de supprimer un utilisateur.

Critères d'acceptation :

- L'administrateur doit confirmer la suppression du compte.
- Le compte de l'utilisateur est supprimé de la base de données.
- L'utilisateur supprimé n'apparaît plus dans la liste des utilisateurs.

## Routes principales

Les routes suivantes sont disponibles pour la gestion des recettes.

| Méthode HTTP | Route                      | Fonction                               |
| ------------ | -------------------------- | -------------------------------------- |
| GET          | `/recettes`                | Afficher la liste des recettes         |
| GET          | `/recettes/create`         | Afficher le formulaire de création     |
| POST         | `/recettes`                | Enregistrer une nouvelle recette       |
| GET          | `/recettes/{recette}`      | Afficher le détail d'une recette       |
| GET          | `/recettes/{recette}/edit` | Afficher le formulaire de modification |
| PATCH        | `/recettes/{recette}`      | Enregistrer les modifications          |
| DELETE       | `/recettes/{recette}`      | Supprimer une recette                  |
| GET          | `/recits/`                 | Afficher les récits utilisateurs       |

Pour afficher toutes les routes enregistrées dans Laravel :

powershell

docker compose exec app php artisan route:list

## Décision concernant les transactions

Une transaction est nécessaire lors de la suppression d'une recette, car cette opération implique plusieurs écritures liées dans la base de données.

Les avis associés à la recette sont supprimés avant la recette afin de respecter la contrainte de clé étrangère entre les tables `Avis` et `Recettes`. Les deux opérations sont exécutées dans une transaction pour garantir qu'elles réussissent ensemble ou qu'elles sont annulées en cas d'erreur.

Aucune transaction n'est nécessaire pour la création d'une recette, car cette opération effectue une seule écriture principale dans la table `Recettes`.

## CI

Le projet utilise GitHub Actions pour construire l'image Docker et vérifier la syntaxe PHP de `public/index.php`.

Le fichier de configuration se trouve dans :

.github/workflows/ci.yml

## Arrêter l'application

Pour arrêter les conteneurs :

powershell

docker compose down

Cette commande conserve les données du volume MySQL.

Pour arrêter les conteneurs et supprimer également le volume de données MySQL :

powershell

docker compose down -v

**Attention :** cette dernière commande supprime le volume de données de la base de données.
