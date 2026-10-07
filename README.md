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

## Démarrage

Une fois les conteneurs démarrés, l'application est accessible à :

http://localhost:8080

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

## CI

Le projet utilise GitHub Actions pour construire l'image Docker et vérifier la syntaxe PHP de `public/index.php`.

Le fichier de configuration se trouve dans :

text
.github/workflows/ci.yml

## Arrêter l'application

powershell
docker compose down

Pour arrêter les conteneurs sans supprimer les données MySQL :

powershell
docker compose down
