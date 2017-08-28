# Events

On utilise le pattern des [Domain events](https://martinfowler.com/eaaDev/DomainEvent.html) :
dans notre "métier", beaucoup d'évènements sont importants. Par exemple, la création d'un intervenant.
On lève alors ces évènements, et nous avons des *listeners* qui vont réagit dessus. 
Cela permet de mieux découper le code et de réutiliser les mêmes choses côté UI, API, ou autre.

**On utilise PAS les events/entity listeners Doctrine, qui posent trop de limites techniques et ne sont pas aussi facilement débugables.**

## Implémentation

Un évènement est une petite classe PHP, placée dans `Event/`.
Elle est nommée par un verbe au passé.  
Elle doit étendre `Symfony\Component\EventDispatcher\Event`.

Généralement on préfère passer les propriétés par le contructeur plutôt que par setters, pour être sûr que tout est bien setté.

On préfère également passer des *valeurs* que des objets pour tracer ce qui est modifié : 
les objets étant passés par référence, on n'a pas forcément leur état définitif !
On admet des exceptions, typiquement le `User` ou `Organization concerné par un évènement (peu de chances que cela change).
Lorsqu'un évènement correspond à la création ou à l'ajout d'un objet, il est également plus logique de passer l'objet.

Exemple, ici on veut savoir quand un `DriveItem` change de taile:

```php
<?php

namespace AppBundle\Event;

use AppBundle\Entity\DriveItem;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SizeChangedEvent.
 */
class SizeChangedEvent extends Event
{
    /**
     * @var int
     */
    private $oldSize = 0;

    /**
     * @var int
     */
    private $newSize;

    /**
     * SizeChangedEvent constructor.
     *
     * @param int $oldSize
     * @param int $newSize
     */
    public function __construct(int $oldSize, int $newSize)
    {
        $this->oldSize = $oldSize;
        $this->newSize = $newSize;
    }

    /**
     * @return int
     */
    public function getOldSize(): int
    {
        return $this->oldSize;
    }

    /**
     * @return int
     */
    public function getNewSize(): int
    {
        return $this->newSize;
    }
}
```

Les évènements métier sont directement levés dans l'entités - il est totalement légitime de les lever depuis un `setter` typiquement :

```php
    /**
     * @param int $size
     *
     * @return DriveItem
     */
    public function setSize(int $size): self
    {
        if (0 !== $this->size || 0 !== $size) {
            $event = new SizeChangedEvent($this->size, $size);
            $this->raise($event);
        }

        $this->size = $size;

        return $this;
    }
```

Ce code est possible car l'entité `DriveItem` implémente l'interface `RaiseEventsInterface` et utilise le trait associé:

```php

use AppBundle\Model\RaiseEventsInterface;
use AppBundle\Model\RaiseEventsTrait;

class DriveItem implements RaiseEventsInterface
{
    use RaiseEventsTrait;
```

Lorsque cette entité sera sauvegardée en base (pour un ajout, un update ou une suppression), les évènements métier seront collectés automatiquement.
Pour les dispatcher sur l'EventDispatcher Symfony, appeler ce code :

```php
$this->get('app.listener.domain_events_collector')->dispatchCollectedEvents();
```

**Note:** cela est automatiquement fait sur le CommandBus. Vous devez le faire dans les controllers n'utilisant pas le CommandBus et les DataFixtures.
Si vous oubliez de le faire, vous aurez une Exception pour vous indiquer votre oubli.

Il suffit maintenant d'implémenter un EventSubscriber et de le plugguer dessus:

```php
<?php

namespace AppBundle\EventListener;

use AppBundle\Event\SizeChangedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class QuotaListener.
 */
class QuotaListener implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            SizeChangedEvent::class => 'onSizeChanged'
        ];
    }

    /**
     * @param SizeChangedEvent $event
     */
    public function onSizeChanged(SizeChangedEvent $event)
    {
        // ...
    }
}
```

Déclaré en tant que service :

```yaml
    app.listener.quota:
        class: AppBundle\EventListener\QuotaListener
        tags:
            - { name: kernel.event_subscriber }
        arguments:
            # ...
```

Et voilà !
Vous pouvez facilemet tracer quels listeners ont été appelés ou pas, en allant dans le [profiler](http://jarvis.local:8080/app_dev.php/_profiler/), onglet `Events`

![events debug](events_debug.png)


## Cas de l'ajout / de la suppression

Dans le cas de la suppression d'une entité, on n'a pas de setter appelé, lever un event semble plus compliqué !  
De même le constructeur peut être appelé trop tôt ou trop souvent pour pouvoir suivre correctement la création de nouvelles entités.

L'astuce dans ce cas est d'utiliser les [entity lifecycle callbacks](http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/events.html#lifecycle-callbacks) de Doctrine.

Exemple sur `DriveItem` :

```php
/**
 * ...
 * @ORM\HasLifecycleCallbacks()
 */
class DriveItem implements RaiseEventsInterface
{
    /**
     * @ORM\PostPersist()
     */
    public function onCreate()
    {
        $event = new DriveItemCreatedEvent($this);

        $this->raise($event);
    }

    /**
     * @ORM\PreRemove()
     */
    public function onRemove()
    {
        $event = new DriveItemRemovedEvent($this);

        $this->raise($event);
    }
    
    // ...
}
```
