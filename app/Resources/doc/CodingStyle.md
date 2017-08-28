# Coding Style

En général, on suit le [Coding style Symfony](http://symfony.com/doc/current/contributing/code/standards.html). 
Le code sera validé par le Php CodeSniffer qui l'applique.
Toutefois on fera un certain nombre d'écarts par rapport aux bonnes pratiques officielles.


## PhpDoc

Toute méthode doit avoir une PhpDoc, y compris les accesseurs.  
Utiliser au maximum le *type hinting* et les types de retours PHP 7.1

Ne pas sauter de ligne au sein de la PhpDoc. Espacer par contre entre les annotations et la PhpDoc :

```php
    /**
     * @var int|null
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $user_id;
```


## Entités

Les entités sont le "coeur" du métier, de notre modélisation.
On essaierai au maximum de les doter de méthodes "intelligentes", qui ont une signification par rapport au métier,
plutôt que d'utiliser que des getters et de faire le travail en dehors.
Les accesseurs inutiles - par exemple permettant de modifier un champ non modifiable, comme une date de création - doivent être retirés.

Par exemple, du `DriveItem` :

```php
    /**
     * @return bool
     */
    public function isEditable() : bool
    {
        return $this->type === self::TYPE_FOLDER || $this->type === self::TYPE_FILE;
    }
    
    /**
     * Get a copy of current DriveItem
     * It will be an exact copy, but the ParentDriveItem you pass
     * If ParentDriveItem is the same, a suffix will be added to name.
     *
     * @param User      $user
     * @param DriveItem $parentDriveItem
     * @return DriveItem
     */
    public function getCopy(User $user, DriveItem $parentDriveItem): DriveItem
    {
        $driveItem = new self();
        $driveItem->setName($this->getName());
        $driveItem->setSize($this->getSize());
        $driveItem->setType($this->type);
        $driveItem->setMimeType($this->getMimeType());
        $driveItem->setUser($user);
        $driveItem->setParentDriveItem($parentDriveItem);
        $driveItem->setSha1($this->getSha1());

        // Then we have to change name to avoid a conflict
        if ($parentDriveItem->getUuid() === $this->parentDriveItem->getUuid()) {
            $driveItem->setName($this->name.' (copie)');
        }

        return $driveItem;
    }
```


On utilise les annotations pour le mapping Doctrine.
Lorsqu'une valeur par défaut n'est pas évidente, il est préférable de l'indiquer :

```php
    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
```


## Managers

Il était conseillé "officiellement" à une époque de faire un `Manager` pour chaque entité, qui s'occupe des interactions avec la base.
On évitera ces services trop génériques et souvent quasiment vides pour :

 * directement l'`EntityManager` Doctrine pour `persist()` et `flush()`
 * les `repositories` pour le requêtage (lecture et certaines écritures)
 * des services métier spécialisés (pas au nom générique !) pour les opérations plus complexes


## Controllers

On utilise au maximum les annotations sur les Controlers, c'est-à-dire `@Route`, `@Method` (à ne pas oublier !), `@Security` si nécessaire, et parfois `@ParamConverter`.
Dans le cas où on utilise un ParamConverter, toujours mettre l'annotation.

On n'utilise pas l'annotation `@Template` (qui est déconseillée).  
Une annotation `@CsrfProtected` est disponible si on souhaite ajoute une protection CSRF.

```php
    /**
     * @Route("/delete/{id}", name="matter_delete")
     * @Method({"GET"})
     * @ParamConverter("matter")
     * @CsrfProtected()
     *
     * @param Matter $matter
     *
     * @return Response
     */
    public function deleteAction(Matter $matter)
    {}
```


## Règles de conception générales

Nous essayons de respecter les règles SOLID pour la conception :
 * encapsuler au maximum dans les objets (pas d'accesseurs inutiles...)
 * exposer - au moins sur les entités - de préférence des méthodes qui exposent un "comportement", plutôt que des setters
 * utiliser des interfaces lorsque plusieurs objets ont un comportement similaire. Leur nom se termine par `Interface`

De plus, préférer faire plusieurs méthodes, au signatures différentes, plutôt qu'une seule à laquelle on passe des `flags`.

Éviter les passages par références. 
Pour les fonctions qui doivent retourner plusieurs valeurs, retourner un tableau, 
qui pourra être lu via `list()`:

```php
function getEntitiesAndCount() {
    $someEntities = []; // ...
    $someCount = 5; // ...
    
    return [$someEntities, $someCount];
}

list($entites, $count) = getEntitiesAndCount();
```

Mieux, utiliser la syntaxe introduite par PHP 7.1 :

```php
function getEntitiesAndCount() {
    $someEntities = []; // ...
    $someCount = 5; // ...
    
    return ['entities' => $someEntities, 'count' => $someCount];
}

['entities' => $entites, 'count' => $count] = getEntitiesAndCount();
```

Bien utiliser la dernière version de PhpStorm afin de ne pas avoir de warnings lors de l'utilisation de cette syntaxe.
