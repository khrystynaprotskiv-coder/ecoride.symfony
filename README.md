# EcoRide - Guide d'installation et de démarrage

EcoRide est une application Symfony dédiée à la gestion de trajets écologiques et de covoiturage.

## Objectif

Objectif de ce projet est développement un plateforme de covoiturage pour les voyageurs soucieux de l'environnement et ceux qui recherchent une solution économique pour leurs déplacements.

## Structure

### App

Dans ce dossier vous pouvez trouver tous les dossiers et fichiers essentiels pour installer ce plateforme sur votre servere local.

- Le dossier bdd contient des fichiers eponymes contenant structures et données.


### Doc

Les diagrammes d’utilisation, de séquence, l'arborescence

Les maquettes maquettes bureautiques, mobiles et wireframes

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés :

- **PHP** (version 8.2 ou supérieure)
- **Composer** (gestionnaire de dépendances PHP)
- **MySQL** (base de données)
- **Git** (contrôle de version)

## Installation du projet


### 1. Installer les dépendances PHP via Composer

Installez toutes les dépendances du projet :

```bash
composer install
```

Cette commande télécharge et installe tous les packages PHP nécessaires au fonctionnement de l'application.

### 2. Configurer le fichier `.env`

Vérifiez ou mettez à jour le fichier `.env` à la racine du projet avec vos paramètres locaux :

```bash
# Exemple de configuration de base de données
DATABASE_URL="mysql://username:password@localhost:3306/ecoride"
```

Assurez-vous que :
- L'utilisateur MySQL existe
- Le mot de passe est correct
- Le serveur MySQL est en cours d'exécution

### 3. Créer la base de données

Créez la base de données :

```bash
php bin/console doctrine:database:create
```

### 4. Exécuter les migrations

Exécutez les migrations pour créer les tables dans la base de données :

```bash
php bin/console doctrine:migrations:migrate
```

Confirmez l'exécution en répondant par `yes` ou `y`.


## Démarrage du serveur

### Démarrer le serveur Symfony

Lancez le serveur de développement Symfony :

```bash
symfony server:start
```

Ou si symfony-cli n'est pas installé, utilisez le serveur PHP intégré :

```bash
php -S localhost:8000 -t public/
```

Le serveur est maintenant accessible à l'adresse :
```
http://localhost:8000
```

### Arrêter le serveur

Pour arrêter le serveur, utilisez :

```bash
symfony server:stop
```


## Architecture du projet

```
ecoride/
├── assets/              # Fichiers JavaScript et CSS
├── bin/                 # Fichiers exécutables (console Symfony)
├── bdd/                 # Scripts SQL pour la base de données
├── config/              # Fichiers de configuration
├── migrations/          # Migrations de base de données
├── public/              # Dossier public (index.php)
├── src/                 # Code source de l'application
│   ├── Controller/      # Contrôleurs
│   ├── Entity/          # Entités Doctrine
│   ├── Form/            # Formulaires Symfony
│   ├── Repository/      # Repositories Doctrine
│   └── Security/        # Classe de sécurité
├── templates/           # Fichiers Twig (templates)
├── tests/               # Tests automatisés
├── translations/        # Fichiers de traduction
├── var/                 # Fichiers temporaires (cache, logs)
└── vendor/              # Dépendances PHP (générées par Composer)
```

## Commandes utiles


### Effacer le cache

```bash
php bin/console cache:clear
```

### Vérifier les routes

```bash
php bin/console debug:router
```

### Créer un nouvel utilisateur admin (si applicable)

```bash
php bin/console make:user
```

## Dépannage

### Erreur de connexion à la base de données

Vérifiez la valeur de `DATABASE_URL` dans `.env` et assurez-vous que :
- Le serveur MySQL est démarré
- Les identifiants sont corrects

### Erreur de permissions

Si vous rencontrez des erreurs de permissions sur le dossier `var/`, exécutez :

```bash
chmod -R 777 var/
```

### Erreur lors de la migration

Vérifiez les logs :

```bash
tail -f var/log/dev.log
```

## Support


Pensez à configurer d'autres variables d'environnement (mailpit) dans .env.local si nécessaire.
Si vous rencontrez des erreurs liées aux migrations ou à la base de données, vérifiez la valeur de DATABASE_URL et les droits d'accès de l'utilisateur DB.

Exemple de trajets :
Marseille - Paris 17/12/2025 places restante 7
Marseille - Paris 25/12/2025 places restante 2


Exemple de user :
email : tester@formation.studi
mdp : 12345678

**Bonne développement avec EcoRide ! 🚗♻️**
