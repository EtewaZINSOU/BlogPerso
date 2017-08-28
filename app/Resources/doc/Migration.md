# Migration

Nous utilisons [Doctrine Migrations](http://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html) pour suivre
les modifications apportées à la base de donnée, et les jouer sur les différents environnements.

En conséquence, il est **interdit** d'utiliser les commandes "manuelles" Doctrine, comme `doctrine:schema:update` !
Sinon nous ne pouvons pas tracer ce qui a été fait.

Nous utilisons les migrations en prod et en dev, mais pas en test - afin de mieux isoler les tests et de pouvoir les lancer de suite,
même si la migration n'a pas encore été écrite.

*Note: notre application utilise une deuxième BDD, `jarvis_action_log`, sur laquelle nous n'utilisons par les migrations 
pour simplifier, celle-ci ne devant pas ou que très peu évoluer.*

## Guide : générer une migration

Disons que je rajoute un nouveau champ dans une entité :

```php
<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table()
 */
class DriveItem
{
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foo;
}
```

Maintenant, plutôt que d'utiliser le `schema:update` de Doctrine, pour mettre à jour ma BDD, je lance cette commande :
`./jarvis.sh console doctrine:migrations:diff`

Doctrine va "deviner" les différences et écrire le code SQL correspondant dans un fichier, par exemple :

> Generated new migration class to "/var/www/jarvis/app/DoctrineMigrations/Version20161229163604.php" from schema differences.

Il suffit maintenant de l'exécuter :
`./jarvis.sh console doctrine:migrations:migrate -n`

Vous devez committer cette nouvelle classe, elle sera utile pour mettre à jour la BDD en production.
