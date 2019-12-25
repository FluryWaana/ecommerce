# ecommerce
Création d'un site ecommerce pour un exercice en cours.

## Récupération du repository
> git clone https://github.com/FluryWaana/ecommerce.git

## Configuration .env

~~~dotenv
APP_ENV=dev
APP_SECRET=5c38b9c3603739e9048a4102f4dd4d59
DATABASE_URL=mysql://root:@127.0.0.1:3306/ecommerce?serverVersion=5.7
~~~

## Base de données

### Création de la database
** /!\ Le serveur MySQL doit être lancé et la database ecommerce ne doit pas exister /!\**
~~~bash
php bin/console doctrine:database:create
~~~

### Création des tables
~~~bash
php bin/console doctrine:migrations:migrate
~~~

### Remplissage des tables avec de fausses données
~~~bash
php bin/console doctrine:fixtures:load
~~~

## Serveur Web Symfony
~~~bash
symfony serve
~~~

Le serveur est disponible par défaut à l'adresse suivante: http://127.0.0.1:8000 ou https://127.0.0.1:8000 si le CA est installé
