# Projet 2026 - Boisson GO

## Présentation

Boisson GO est un site de vente de boissons réalisé dans le cadre du cours de Technologies Internet 2.

Le projet a été développé en PHP orienté objet avec une base de données PostgreSQL. Il permet à un utilisateur de consulter un catalogue de boissons, créer un compte, se connecter, gérer son panier et passer des commandes. Une partie administration permet de gérer les boissons et consulter les commandes des clients.

---

## Technologies utilisées

* PHP 8
* PostgreSQL
* HTML5
* CSS3
* Bootstrap 5
* JavaScript
* AJAX (Fetch API)
* GitHub

---

## Architecture du projet

Le projet respecte une organisation séparant les différentes responsabilités :

* `classes/` : classes métier et DAO
* `content/` : pages publiques
* `admin/` : partie administration
* `assets/css/` : feuilles de style
* `assets/js/` : scripts JavaScript
* `plpgsql/` : fonctions PostgreSQL
* `backups/` : sauvegarde de la base de données

Un autoloader est utilisé afin de charger automatiquement les classes du projet.

---

## Fonctionnalités publiques

### Catalogue des boissons

L'utilisateur peut :

* consulter la liste des boissons disponibles
* filtrer les boissons par catégorie grâce à AJAX
* visualiser les images des produits
* consulter le prix et le stock disponible

### Gestion du compte

L'utilisateur peut :

* créer un compte
* se connecter
* se déconnecter

Les mots de passe sont stockés de manière sécurisée grâce au système de hachage de PHP.

### Panier

L'utilisateur peut :

* ajouter des boissons au panier
* consulter le contenu du panier
* visualiser le total de la commande
* valider une commande

Un contrôle empêche d'ajouter une quantité supérieure au stock disponible.

### Commandes

L'utilisateur peut :

* consulter l'historique de ses commandes
* afficher le détail de chaque commande

---

## Fonctionnalités administrateur

L'administrateur dispose d'un espace sécurisé accessible uniquement après authentification.

### Gestion des boissons

CRUD complet :

* ajout d'une boisson
* modification d'une boisson
* suppression d'une boisson
* gestion des images

### Gestion des commandes

L'administrateur peut :

* consulter toutes les commandes
* afficher le détail d'une commande
* identifier le client ayant passé la commande

---

## Gestion du stock

Lorsqu'une commande est validée :

* les détails de commande sont enregistrés
* le stock des boissons est automatiquement diminué
* une boisson en rupture de stock ne peut plus être commandée

---

## Base de données

Le projet utilise PostgreSQL.

Les opérations d'ajout, de modification et de suppression utilisent des fonctions PL/pgSQL.

Les principales fonctions sont :

* ajouter_boisson
* modifier_boisson
* supprimer_boisson
* ajouter_utilisateur
* ajouter_commande
* ajouter_detail_commande
* diminuer_stock_boisson

Le dump complet de la base est disponible dans le dossier `backups`.

---

## Sécurité

Le projet intègre plusieurs mécanismes de sécurité :

* accès administrateur protégé
* vérification des sessions
* mots de passe hachés
* utilisation de requêtes préparées PDO
* contrôle des accès aux pages sensibles

---

## Auteur

Projet réalisé par Kula Noah dans le cadre du cours de Technologies Internet 2.
