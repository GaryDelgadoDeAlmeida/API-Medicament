# API-Medicament

## Configuration

### Prérequis

PHP => 7.3
Symfony 4.4

### Installation

```bash
  composer install
```

### Database

#### Sources de données
- niveau national :
  - http://base-donnees-publique.medicaments.gouv.fr/telechargement.php

#### Terminal

Créer la database :
```bash
  php bin/console doctrine:database:create
```

Générer les tables (pour la database) :
```bash
  php bin/console make:migration
```

Sauvegarder les modifications dans la database :
```bash
  php bin/console doctrine:migrations:migrate
```

### Mise à jour

Mets à jour les dépendances du projet :
```bash
  symfony update
```

### Apache Serveur

Dans le répertoire du project :
```bash
  composer require symfony/apache-pack
```

Les configurations restantes (pour la mise en production) seront à faire à travers ce lien <a href="https://symfony.com/doc/current/setup/web_server_configuration.html" target="__blank">https://symfony.com/doc/current/setup/web_server_configuration.html</a>

## Documentation

### Route

- /medicament
- /medicament/{id}

### Command
- symfony console app:import:avis-asmr
- symfony console app:import:avis-smr
- symfony console app:import:composition
- symfony console app:import:group-generique
- symfony console app:import:info
- symfony console app:import:medicament
- symfony console app:import:page-link
- symfony console app:import:prescription-condition
- symfony console app:import:presentation
