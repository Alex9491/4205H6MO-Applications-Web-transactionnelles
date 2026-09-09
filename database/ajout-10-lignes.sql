USE `mydb`;

INSERT INTO `Utilisateurs` (`idUtilisateurs`, `nom`, `courriel`, `motdepasse`, `role`) VALUES
(1, 'Alex', 'alex@gmail.com', '123', 'user'),
(2, 'William', 'william@gmail.com', '123', 'user'),
(3, 'Admin', 'admin@gmail.com', '123', 'admin');

INSERT INTO `Categories` (`idcategorie`, `nom`) VALUES
(1, 'Plats'),
(2, 'Desserts');

INSERT INTO `Recettes` (`idrecette`,`idutilisateur`,`idcategorie`,`nom`,`description`) VALUES
(1, 1, 1, 'Pizza', 'Pizza au fromage et tomate.'),
(2, 1, 1, 'Burger', 'Burger avec bœuf et fromage.'),
(3, 1, 1, 'Lasagnes', 'Lasagnes à la viande et fromage.'),
(4, 1, 2, 'Crêpes', 'Crêpes simples au sucre.'),
(5, 1, 2, 'Gâteau', 'Gâteau au chocolat.'),
(6, 1, 1, 'Poulet', 'Poulet rôti aux légumes.'),
(7, 1, 1, 'Poutine', 'Frites, fromage et sauce brune.'),
(8, 1, 1, 'Spaghetti', 'Spaghetti avec sauce tomate et viande.'),
(9, 1, 1, 'Pain de viande', 'Pain de viande accompagné de pommes de terre et légumes.'),
(10, 1, 1, 'Soupe aux légumes', 'Soupe chaude avec carottes, pommes de terre et légumes variés.');