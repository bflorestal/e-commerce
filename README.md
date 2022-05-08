# Projet E-commerce

## Equipe :
Trinôme : Bryan, Maxime, Pascal

## Configuration :
1/ Configurer le .env

2/ Installation des dépendances avec `composer install`

3/ Création de la base de données avec `php bin/console d:d:c`

4/ S'il y a des migrations, les executer avec `php bin/console d:m:m`

5/ Installer yarn avec `yarn install`

6/ Lancer `yarn watch`

Votre projet est prêt, vous pouvez lancer `symfony serve`

***

# INFORMATIONS

## Page d'accueil :
http://127.0.0.1:8000/

- Connexion et inscription.

## AUTRES PAGES PRINCIPALE :
    - Games (Produit)
    - Details du produit
    - Account (Compte)
    - Balance (Panier)

## Base de donnée pour tester :

#### USER ADMIN & USER SUPER ADMIN :

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date`, `date_inscription`) VALUES
(14, 'superadmin@superadmin.superadmin', '[\"ROLE_SUPER_ADMIN\",\"ROLE_ADMIN\"]', '$2y$13$mJdgp0uWJPKr8gEWn5yEFOJ36xNRYnYE.gJBsHk13NZVssd2pp7Ay', 'SuperAdmin', 'SuperAdmin', '2022-05-08 09:08:57', '2022-05-08'),
(15, 'admin@admin.admin', '[\"ROLE_ADMIN\"]', '$2y$13$vUfIQ.0sva.EXU4XcnJNp.GDTCjW6MduoLrIU58afDAxG1EYZJ8rm', 'Admin', 'Admin', '2022-05-08 09:09:25', '2022-05-08');

#### Password Super_Admin : SuperAdmin2022
#### Password Admin : Admin2022

## PRODUIT DE TEST :

INSERT INTO `produit` (`id`, `nom`, `description`, `prix`, `stock`, `photo`) VALUES
(5, 'GTA V', 'Grand Theft Auto V est un jeu vidéo d\'action-aventure, développé par Rockstar North et édité par Rockstar Games. Il est sorti en 2013 sur PlayStation 3 et Xbox 360, en 2014 sur PlayStation 4 et Xbox One, en 2015 sur PC puis en 2022 sur PlayStation 5 et Xbox Series.', 19.99, 100, '6274f97c08c39.jpg'),
(6, 'Call of Duty: Modern Warfare 3', 'Call of Duty: Modern Warfare 3 est un jeu vidéo de tir à la première personne développé conjointement par Infinity Ward et Sledgehammer Games ainsi que Raven Software pour la partie multijoueur, et édité par Activision en novembre 2011.', 73.1, 150, '6274f9f677bf1.jpg'),
(8, 'FIFA 22', 'FIFA 22 est un jeu vidéo de simulation de football publié par Electronics Arts. Il s\'agit du 29ᵉ volet de cette série FIFA. Il est sorti sur Microsoft Windows, Nintendo Switch, Play Station 4, PlayStation 5, Google Stadiaet, le 1ᵉʳ octobre 2021.', 39.99, 45, '62750d6a5b398.jpg'),
(9, 'Grand Theft Auto: Vice City Stories', 'Grand Theft Auto: Vice City Stories est un jeu vidéo d\'action-aventure en monde ouvert développé par les studios Rockstar Leeds et Rockstar North et distribué par Rockstar Games. Il s\'agit du dixième jeu de la série Grand Theft Auto', 59.9, 25, '6275a1856934c.jpg');

***

# Admin:
    - See a product,
    - Add a product;
    - Manage product,
    - Delete product,
    And more...
# Super-Admin :
    - See a product,
    - Registered today,
    - Unpaid order,
    - Add a product;
    - Manage product,
    - Delete product,
    And more...
# User :
    - See a product,
    - see his account,
    - Unpaid orde in Balance,
    - Order pay in this account page;
    - Manage his account,
    - Get details of his order,
    And more...

# Product :
    - Si vous insérer aucune images, une image par default sera mise.
    - Lien vers des images : https://www.swisstransfer.com/d/52b26ddf-1600-4224-acf2-ee5250f31718 (expire le 07/06/2022 à 11:22)
