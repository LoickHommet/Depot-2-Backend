# Mon Projet Backend

## Introduction

Mon Projet Backend est une API RESTful construite avec Laravel pour gérer les dépenses des utilisateurs. Il fournit des points de terminaison pour ajouter, mettre à jour, supprimer et récupérer des dépenses.

## Installation

### Prérequis

- PHP (version 8.0 ou supérieure)
- Composer
- MySQL (ou autre base de données compatible)

### Instructions d'installation

1. Clonez le dépôt : git clone https://github.com/mon-utilisateur/mon-projet-backend.git
2. cd backend
3. composer install
4. Configurez la base de données dans le fichier .env

### Démarrer le Projet

- docker compose up --build
- Entrer dans le conteneur laravel-app : docker exec -it laravel-app bash  
- php artisan migrate

### Endpoint

## Authentification

- POST /api/register : Crée un nouvel utilisateur.
- POST /api/login : Authentifie un utilisateur.
- POST /api/logout : Déconnecte l'utilisateur.

## Dépenses

- GET /api/expenses : Récupère toutes les dépenses.
- GET /api/expenses/{id} : Récupère une dépense spécifique par son ID.
- POST /api/addExpenses : Ajoute une nouvelle dépense.
- PUT /api/expenses/edit/{id} : Modifie une dépense existante.
- DELETE /api/expenses/delete/{id} : Supprime une dépense existante par son ID.

## Catégories

- GET /api/expenses/categories : Récupère les catégories de dépenses disponibles.

## Dépenses Mensuelles

- GET /api/monthly : Récupère les dépenses mensuelles.

## Dépenses par Catégorie

- GET /api/category-expenses : Récupère les dépenses organisées par catégorie.


- 
