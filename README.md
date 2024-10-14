# ETERNELLEBESACE - Ma jolie besace

J'ai essayé de créer un site web e-commerce pour la vente de sacs à main. Il n'est pas terminé et il manque des fonctionnalités pour que le site soit actif. Cependant, j'ai beaucoup travaillé sur ce projet et je vais continuer car c'est passionnant.

## Table des Matières

- [Installation](#installation)
  - Symfony 6.4
  - Installation de Symfony CLI
  - PHP (WAMP / MySQL)
  - Installer Composer
  - GitHub
  - Bootstrap et intégration de templates
  - VSCode
  - EasyAdminBundle V4

- [Gestion des Utilisateurs](#gestion-des-utilisateurs)
  - Commande `make:user`
  - Commande `make:entity`
  - Configuration de la base de données
  - Création du système d'enregistrement utilisateur
  - Validation des données avec le composant Validator
  - Création du système de login
  - Système de navigation avec les tables
  - Formulaire de modification du mot de passe
  - Gestion des utilisateurs

- [Administrateur](#administrateur)
  - Installation, configuration et mapping de l'entité User avec EasyAdmin

- [Les Produits](#les-produits)
  - Création de l'entité Category et son mapping dans EasyAdmin
  - Mapping des produits et de leurs images dans EasyAdmin
  - Suppression des images produit avec EventSubscriber et `unlink()`
  - Affichage des produits
  - Ajout d'un filtre sur les produits
  - Pagination (6 produits max affichés par page en fonction du filtrage)

- [Gestion du Panier](#gestion-du-panier)
  - Création du système panier avec les fonctions fournies par `SessionInterface`
  - Création de la vue récapitulatif du panier
  - Gestion du panier : supprimer ou ajouter des articles

- [Gestion des Adresses](#gestion-des-adresses)
  - Création de l'entité Adresse pour nos utilisateurs
  - Gestion des adresses : en cours

## À Faire
- Gestion des commandes
- Paiement
- Affichage des commandes et factures
- Envoi d'emails
- Sécurisation des URLs