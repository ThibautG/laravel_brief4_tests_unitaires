# Tests et Intégration

[![CI Tests](https://github.com/ThibautG/laravel_brief4_tests_unitaires/actions/workflows/laravel-tests.yml/badge.svg)](https://github.com/ThibautG/laravel_brief4_tests_unitaires/actions/workflows/laravel-tests.yml)

![PHP](https://img.shields.io/badge/PHP-8.2-blue?logo=php)

![Laravel](https://img.shields.io/badge/Laravel-12.20.0-red?logo=laravel)

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
- Toutes les vues sont bien utilisées
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

- [tests/Unit/ProductTest.php](tests/Unit/ProductTest.php)
- [tests/Feature/ProductControllerTest.php](tests/Feature/ProductControllerTest.php)

Une modif à prévoir sur `ProductControllerTest.php` pour la fonction 
`test_product_controller_update`: pour l'instant je teste seulement si la 
modif a bien eu lieu dans la DB mais pas dans le front !
