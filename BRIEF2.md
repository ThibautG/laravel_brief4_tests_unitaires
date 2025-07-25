# Intégration continue avec GitHub Actions

Vous travaillez dans une boutique spécialisée. Après avoir mis en place un système de gestion des produits (CRUD Laravel) ainsi des tests unitaires et fonctionnels, l'équipe souhaite encore améliorer la fiabilité du code en automatisant les tests à chaque modification.

## Ressources

- [L'intégration continue](https://www.ibm.com/fr-fr/think/topics/continuous-integration)
- [CI dans Github Actions](https://docs.github.com/fr/actions/concepts/overview/continuous-integration)
- [Comprendre Github Actions](https://docs.github.com/fr/actions/get-started/understanding-github-actions)
- [Laravel et Github Actions](https://laravel-france.com/posts/automatisez-vos-tests-avec-github-actions)

## Contexte du projet

En tant que développeur Web, vous êtes chargé de mettre en place l’intégration continue via GitHub Actions.

## Modalités pédagogiques

### Objectifs :

* Comprendre le fonctionnement de GitHub Actions.
* Créer un fichier de workflow YAML pour exécuter les tests Laravel.
* Savoir utiliser une base de données de test (SQLite in-memory).
* Automatiser le processus de test à chaque push ou pull request.

### Étapes :

1. Créez un fichier .github/workflows/laravel-tests.yml.
2. Le pipeline doit :
    1. Installer PHP, Composer, et les dépendances.
    2. Exécuter les migrations (php artisan migrate).
    3. Lancer les tests (php artisan test).
3. Affichez un badge de statut dans le README.md.

## Modalités d'évaluation

Le fichier yml est bien construit et fonctionnel\
Les tests s'exécutent correctement\
Le badge GitHub Actions est présent

## Critères de performance

PHP, Composer et les dépendances sont bien installer via le fichier yml\
Les tests sont fonctionnels
