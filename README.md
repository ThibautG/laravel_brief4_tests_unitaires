# Tester un projet (CRUD Laravel)

Vous travaillez dans une boutique spécialisée Apple. Après avoir mis en place un système de gestion des produits (CRUD Laravel), vous devez garantir que toutes les fonctionnalités sont fiables, testées automatiquement et fonctionnent à chaque mise à jour.

## Ressources

- [Les tests unitaires](https://www.all4test.fr/blog-du-testeur/test-unitaire-guide-complet/)
- [Les tests fonctionnels](https://www.all4test.fr/blog-du-testeur/quest-ce-test-fonctionnel-tutoriel-complet-exemples/)
- [Tests unitaires avec Laravel](https://kinsta.com/fr/blog/tests-unitaires-laravel/)
- [Documentation de Laravel et tests](https://laravel.com/docs/12.x/testing)

## Contexte du projet

En tant que développeur Web, l’équipe vous confie la responsabilité d’écrire des tests automatisés pour couvrir les principales fonctionnalités.

## Modalités pédagogiques

### Objectifs :

* Savoir écrire des tests unitaires (modèle Laravel).
* Savoir écrire des tests fonctionnels (routes, contrôleurs).
* Utiliser les factories, les migrations, et RefreshDatabase.
* Vérifier les validations, les vues retournées, les redirections.

### Étapes :

1. Test unitaire
   1. Vérifier qu'un produit peut être crée avec des données valides (prix 
   numérique, le stock est un entier etc...)
   2. Vérifier les autres fonctionnalités du CRUD
2. Test fonctionnel (ProductControllerTest) :
   1. Listes les produits et vérifier le code 200
   2. Créer un produit via un POST et vérifier qu'il est bien enregistrer en BDD
   3. Vérifier les erreurs de validation (par exemple, si le nom est vide)
   4. Modifier un produit existant et vérifier que la mise à jour est correct
   5. Supprimer un produit et vérifier qu'il disparait de la BDD
3. Pour finir :
   1. Vérifier que les vues sont bien utilisées
   2. Tester l'affichage des messages de succès

Il faut que vos tests couvrent un maximum (idéalement toutes) de possibilités. À vous de corriger le code lors d'un échec lors des tests.


## Tests effectués

### Manuellement

- Création nouveau produit - OK
- Modification produit - OK
- Affichage succès après MAJ produit - OK
- Suppression produit - OK
- Validation avant suppression - OK
- Affichage succès après suppression - OK
- Détails produit - OK
- Route modif depuis détails - OK
- Route suppression depuis détails - OK
- Redirection après modif ou supp - OK
- Modification des btn redirection dans edit view - OK
- Lister les produits code 200 - OK
- Le CRUD est sauvegardé en BDD - OK
- Vérifier erreurs validation formulaire:
  - Stock doit être un entier - OK (front)
  - Prix à virgule converti en point dans BDD - OK
  - Nom vide - OK (front)
  - Stock non vide - OK
  - Prix number - OK
  - Protection injection SQL - OK
  - Limiter nb de caractères - NOK
    - Modif ProductController
      - `'name' => 'required|string|max:50'`
      - `'description' => 'nullable|string|max:255'`
      - `'price' => 'required|numeric|min:0|decimal:0,2'`
      - `'stock' => 'required|integer|min:0'`
      - ==> OK pour `store` et `update`
    - Modifier les vues create et edit - ajout `maxLength` ==> OK

### Automatisés 

Voir [tests/Unit/ProductTest.php](tests/Unit/ProductTest.php)
