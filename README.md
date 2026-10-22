# BiblioNet

Application web de gestion d'une bibliothèque (livres, adhérents, emprunts), développée en **PHP 8 orienté objet** avec l'architecture **MVC**, sans framework.

Mini-projet du module Développement web (PHP / MySQL), enseignant : Charly OBAME.

## Équipe

| Membre | Nom | Responsabilité |
|--------|-----|----------------|
| Membre 1 | Christian | Socle MVC, authentification, GitHub, mise en ligne |
| Membre 2 | OLORUNTO | Livres (CRUD) et catalogue public |
| Membre 3 | Dash | Emprunts et retours |
| Membre 4 | Alma | Adhérents (CRUD) et base de données |

## Fonctionnalités

- Connexion / déconnexion du bibliothécaire (mot de passe haché, session)
- Gestion des livres (ajout, modification, suppression, liste)
- Gestion des adhérents
- Enregistrement des emprunts et des retours (emprunt refusé si aucun exemplaire disponible)
- Catalogue public avec recherche par titre ou auteur et mention « Disponible / Indisponible »

## Technologies

- PHP 8.x orienté objet, sans framework
- MySQL / MariaDB avec PDO et requêtes préparées
- HTML5, CSS3, Bootstrap 5.3 (fichiers installés en local)

## Structure du projet

```
biblionet/
├── app/
│   ├── controllers/   contrôleurs (Auth, Livre, Adherent, Emprunt, Catalogue)
│   ├── models/        modèles (User, Livre, Adherent, Emprunt)
│   ├── views/         vues et layout (layouts/main.php)
│   └── core/          Router.php, Controller.php, Database.php
├── config/
│   └── config.php     lit les paramètres du fichier .env
├── public/            seul dossier exposé au web
│   ├── index.php      point d'entrée unique (front controller)
│   ├── .htaccess      réécriture d'URL
│   └── assets/        css/ et js/ (Bootstrap)
├── database/
│   └── biblionet.sql  création des tables + données de test
├── .htaccess          redirige vers public/ (hébergement)
├── .env.example
├── .gitignore
└── README.md
```

## Installation en local (XAMPP)

1. Cloner le projet dans `C:\xampp\htdocs` :
   ```
   git clone https://github.com/christianmuya75-ops/biblionet.git
   ```
2. Copier `.env.example` et nommer la copie `.env`, puis adapter si besoin :
   ```
   APP_ENV=local
   DB_HOST=localhost
   DB_NAME=biblionet
   DB_USER=root
   DB_PASS=
   ```
3. Démarrer **Apache** et **MySQL** dans XAMPP.
4. Ouvrir `http://localhost/phpmyadmin`, créer une base nommée `biblionet`, puis cliquer sur **Importer** et choisir `database/biblionet.sql`.
5. Lancer le serveur depuis le dossier du projet :
   ```
   C:\xampp\php\php.exe -S localhost:8000 -t public
   ```
6. Ouvrir `http://localhost:8000`.

## Compte de démonstration

- Email : `admin@biblionet.ga`
- Mot de passe : `admin123`

## Travail en équipe (Git)

- Chaque membre travaille sur sa propre branche (`livres`, `emprunts`, `adherents`...).
- Les modifications sont intégrées dans `main` par pull request, validée par le Membre 1.

## Mise en ligne

- URL de l'application : *à compléter*
- Compte de démonstration en ligne : *à compléter*
- Hébergement : InfinityFree (hébergement mutualisé), dossier `htdocs`, fichier `.env` créé directement sur le serveur (jamais envoyé sur GitHub), affichage des erreurs désactivé en production.