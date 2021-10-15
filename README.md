## Test Technique Maline

### Pré-requis

- serveur web (Wamp64, ...)
- mise à jour des vhosts (en fonction de votre environnement)
- mise à jour des hosts (exemple ``127.0.0.1 testTech``)

### Installation

Veuillez finir d'installer le projet :

``- composer install``

``- yarn install `` ou ``npm install``

``- yarn encore dev``


### Démarrage

Démarrer le serveur
``php -S localhost:8000 -t public
``

ou lancons le server web local de symfony

``- php bin/console server:run``

``- symfony server:start``  (si symfony/cli est installé) 

Rendez-vous sur la page d'accueil. Vous devriez voir apparaître : 
"Welcome to Symfony 4.4.32"

### Configuration du projet

Pour exécuter le projet et les tests vous devez démarrer un serveur Web ainsi qu'un serveur de base de données.

Ajouter le fichier `.env.test.local` pour y mettre les informations de connexion à la base de données.

### Mise en place de la base de données et tests

``- php bin/console doctrine:database:create``

``- php bin/console doctrine:schema:update --force``

``- php bin/console doctrine:fixtures:load``

``- php bin/phpunit``


## A réaliser 

Développez une mini application qui permettra d'afficher et de modifier des appartements.

La page d'accueil actuelle "Welcome to Symfony 4.4.32" sera remplacée par la liste des appartements.

La liste des appartements permettra d'afficher les appartements et de les modifier. En effet, la sélection d'un appartement affichera un formulaire pour le mettre à jour.
Le formulaire peut-être affiché sur la même page ou sur une autre.

Un appartement est défini par : une adresse, un étage, un nombre de pièce, la présence d'un ascenceur.
La contrainte est que deux appartements ne peuvent pas avoir la même adresse.
Nous allons partir du principe qu'une adresse est stockée dans un unique champ.

Des tests unitaires devront stabiliser l'application.

N'oubliez pas de compléter le README.md (lancement des tests ect).

### Retour : 

Vous disposerez de 7 jours dès réception du test pour le renvoyer. Vous pouvez le renvoyer avant.
Une fois le test terminé, merci de l'envoyer à ``narnodo@maline-immobilier.fr`` et de préciser : 
- méthode pour récupérer le test (de préférence sur git sinon weTransfert)
- temps total passé sur le test
- reste à faire
- pistes d'amélioration dans le travail réalisé

> les réponses a ces questions seront sur reponses.md

#### Autre 

Je reste à votre disposition si nécessaire, n'hésitez surtout pas à me contacter si besoin : ``narnodo@maline-immobilier.fr``

Pour rappel, ce test évaluera principalement vos démarches et vos bonnes pratiques.

Le délais de 7 jours doit vous permettre de vous organiser, pas de travailler 10h sur le test ;)
