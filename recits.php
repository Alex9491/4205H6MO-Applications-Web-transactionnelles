<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <p>
            L'application permet de résoudre le problème de la difficulté à organiser des recettes et des menus.
        </p>
        <p> 
            Les personnes qui utiliseront cette application seront toutes celles qui s'intéressent à la cuisine, comme les cuisiniers et les personnes qui souhaitent découvrir de nouvelles recettes et trouver des idées de recettes. 
        </p>
        <p>Rôles:</p>
            <ul>
                <li>Guest</li>
                <li>User</li>
                <li>Admin</li>
            </ul>
        <p>Resources: </p>
            <ul>
                <li>Utilisateur</li>
                <li>Recettes</li>
                <li>Menus</li>
                <li>Avis</li>
                <li>Catégories</li>
                <li>Favoris</li>
            </ul>
            <ol>

    <li>
        En tant que guest, je veux être capable de créer un compte.
        <ul>
            <li>Une personne ne peut pas s'inscrire 2 fois avec le même courriel.</li>
            <li>Si l'inscription réussit, un message de réussite est affiché et l'utilisateur est redirigé vers la page de connexion.</li>
            <li>Si l'inscription échoue, un message d'erreur est affiché et l'utilisateur n'est pas redirigé vers la page de connexion.</li>
        </ul>
    </li>

    <li>
        En tant que guest, je veux me connecter sur le site.
        <ul>
            <li>La connexion est refusée si le courriel ou le mot de passe est incorrect.</li>
            <li>Si le courriel et le mot de passe sont corrects, l'utilisateur est redirigé vers l'écran d'accueil.</li>
            <li>Un message d'erreur est affiché lorsque les informations sont incorrectes.</li>
        </ul>
    </li>

    <li>
        En tant que user/guest, je veux rechercher une recette.
        <ul>
            <li>Le site redirige l'utilisateur vers la page de la recette si elle est trouvée.</li>
            <li>Le site redirige l'utilisateur vers une page d'erreur si la recette n'est pas trouvée.</li>
            <li>La recherche permet de trouver une recette à partir de son nom.</li>
        </ul>
    </li>

    <li>
        En tant que user/guest, je veux rechercher un menu.
        <ul>
            <li>Le site redirige l'utilisateur vers la page du menu si celui-ci est trouvé.</li>
            <li>Le site redirige l'utilisateur vers une page d'erreur si le menu n'est pas trouvé.</li>
            <li>La recherche permet de trouver un menu à partir de son nom.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux créer une recette.
        <ul>
            <li>Le nom de la recette est obligatoire.</li>
            <li>La recette est enregistrée dans la base de données.</li>
            <li>La nouvelle recette apparaît dans la liste des recettes.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux modifier une recette.
        <ul>
            <li>L'utilisateur peut modifier les informations de sa recette.</li>
            <li>Les modifications sont enregistrées dans la base de données.</li>
            <li>La recette affiche les nouvelles informations après la modification.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux supprimer une recette.
        <ul>
            <li>L'utilisateur doit confirmer la suppression de la recette.</li>
            <li>La recette est supprimée de la base de données.</li>
            <li>La recette supprimée n'apparaît plus dans la liste des recettes.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux créer un menu.
        <ul>
            <li>Le nom du menu est obligatoire.</li>
            <li>Le menu est enregistré dans la base de données.</li>
            <li>Le nouveau menu apparaît dans la liste des menus.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux modifier un menu.
        <ul>
            <li>L'utilisateur peut modifier les informations de son menu.</li>
            <li>Les modifications sont enregistrées dans la base de données.</li>
            <li>Le menu affiche les nouvelles informations après la modification.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux supprimer un menu.
        <ul>
            <li>L'utilisateur doit confirmer la suppression du menu.</li>
            <li>Le menu est supprimé de la base de données.</li>
            <li>Le menu supprimé n'apparaît plus dans la liste des menus.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux ajouter une recette à un menu.
        <ul>
            <li>L'utilisateur peut sélectionner une recette existante.</li>
            <li>La recette est ajoutée au menu sélectionné.</li>
            <li>Une même recette ne peut pas être ajoutée 2 fois au même menu.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux ajouter un avis sur une recette.
        <ul>
            <li>L'utilisateur doit être connecté pour ajouter un avis.</li>
            <li>L'avis est enregistré dans la base de données.</li>
            <li>L'avis apparaît sur la page de la recette.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux ajouter un avis sur un menu.
        <ul>
            <li>L'utilisateur doit être connecté pour ajouter un avis.</li>
            <li>L'avis est enregistré dans la base de données.</li>
            <li>L'avis apparaît sur la page du menu.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux ajouter une recette aux favoris.
        <ul>
            <li>L'utilisateur doit être connecté pour ajouter une recette aux favoris.</li>
            <li>La recette apparaît dans la liste des favoris de l'utilisateur.</li>
            <li>Une même recette ne peut pas être ajoutée 2 fois aux favoris.</li>
        </ul>
    </li>

    <li>
        En tant que user, je veux ajouter un menu aux favoris.
        <ul>
            <li>L'utilisateur doit être connecté pour ajouter un menu aux favoris.</li>
            <li>Le menu apparaît dans la liste des favoris de l'utilisateur.</li>
            <li>Un même menu ne peut pas être ajouté 2 fois aux favoris.</li>
        </ul>
    </li>

    <li>
        En tant que admin, je veux être capable de supprimer un utilisateur.
        <ul>
            <li>L'administrateur doit confirmer la suppression du compte.</li>
            <li>Le compte de l'utilisateur est supprimé de la base de données.</li>
            <li>L'utilisateur supprimé n'apparaît plus dans la liste des utilisateurs.</li>
        </ul>
    </li>

</ol>
    </div>
</body>
</html>