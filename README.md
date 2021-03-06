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

L'application web est en mode Prod. Cela permet l'utilisation des pages d'erreurs personnalisées.

## Chnagement de la langue :
Par default la langue est sur "fr", pour changer la langue vers "en", rendez-vous dans : 
### config/packages/translation.yaml
### default_locale: en

***

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

    - INSERT INTO `user` (`id`, `email`, `roles`, `password`, `nom`, `prenom`, `date`, `date_inscription`) VALUES (14, 'superadmin@superadmin.superadmin', '[\"ROLE_SUPER_ADMIN\",\"ROLE_ADMIN\"]', '$2y$13$mJdgp0uWJPKr8gEWn5yEFOJ36xNRYnYE.gJBsHk13NZVssd2pp7Ay', 'SuperAdmin', 'SuperAdmin', '2022-05-08 09:08:57', '2022-05-08'), (15, 'admin@admin.admin', '[\"ROLE_ADMIN\"]', '$2y$13$vUfIQ.0sva.EXU4XcnJNp.GDTCjW6MduoLrIU58afDAxG1EYZJ8rm', 'Admin', 'Admin', '2022-05-08 09:09:25', '2022-05-08');

#### Password Super_Admin : SuperAdmin2022
#### Password Admin : Admin2022

# Lien vers la base de donné de test :

https://www.swisstransfer.com/d/64f419af-4b7c-43ed-8adc-fcc817538eae (expire le 07/06/2022 à 11:34)

Cette base intègre des donnés permettant de tester les fonctions autours du panier.
L'ajout d'un article dans un panier et sa validation ne sont pas fonctionnels.

Cepandant avec la base de test il est possible de tester les fonctionnalités sautour du panier.

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
    - Create account,
    - Login,
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

#### Password USER : lol@lol.lol : LOL1272
#### Password USER : mimi@mimi.mimi : MIMI1272 
