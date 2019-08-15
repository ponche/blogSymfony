# Premier test sur Symfony 

en cours de création

## Prérequire

- PHP7.2 
- composer 

## Comment installer 

1. modifier le fichier **.env** pour l'accès à la base de donné 
2. lancer `composer install` pour installer les dépandances 
3. lancer `php bin/console doctrine:database:create` pour crée la BDD
4. lancer `php bin/console do:mi:mi`pour lancer les migration de la BDD
5. lancer `php bin/console do:fixtures:load`pour générer des fauses données


