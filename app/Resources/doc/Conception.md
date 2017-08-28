# Conception

Ce document va décrire les différentes entités et leur rôle. Il met en place le vocabulaire *unique* (et leurs noms en français).
Dans le code, tout doit être en anglais.

Ce document est divisé en différentes parties :

 * le "core" ici
 * [User](Conception/User.md) (`LawFirm`, `User`...)


  
# Traits

## `HasUploadableFileTrait` / Trait HasUploadedFileTrait
       
Détermine l'ensemble des propriétés relatives et nécessaires à l'upload d'un fichier
       
Propriétés:
 * `uploadedFile` de type UploadedFile, utilisée dans le formulaire de contact
 * `filePath` clé permettant la recherche du fichier dans Flysystem

  
# Enum

Lorsqu'un choix doit être fait entre des données fixes pour une entité, qu'il faut implémenter des select dans les 
formulaires, il faudra implémenter une classe pour cela.

Votre classe présentant les données devra être placée dans un dossier Enum dans le bundle concerné. Cette classe devra
étendre AbstractEnum située dans le CommonBundle. 

Vous devrez implémenter getChoices qui devra retourner les différentes options disponibles. Ce sera les données que 
vous retrouverez dans la base.

Voici un exemple d'Enum :

```php
<?php

namespace AppBundle\Enum;

/**
 * Class UserTypeEnum.
 */
class UserTypeEnum extends AbstractEnum
{
    const ADMINISTRATOR = 'administrator';
    const ASSOCIATE = 'associate';
    const COLLABORATER = 'collaborater';
    const TRAINEE = 'trainee';

    /**
     * {@inheritdoc}
     */
    public static function getChoices(): array
    {
        return [
            self::ADMINISTRATOR,
            self::ASSOCIATE,
            self::COLLABORATER,
            self::TRAINEE,
        ];
    }
}

```

Dans les différents formulaires liés aux entités utilisant l'enum, vous pouvez réutiliser les enum : 

```php
<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class MatterType.
 */
class MatterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('state', ChoiceType::class, [
                'label' => 'matter.state.title',
                'choices' => UserTypeEnum::getChoices(),
            ])
        ;
    }
}
```

Vous pouvez traduire les labels des select ; ils sont générés suivant cette règle : "enum.NOMDELACLASSE.VALEUR".

Par exemple "enum.MatterStateEnum.open".

Vous pouvez valider les données dans le setter en vérifiant que la donnée saisie est bien présente dans le tableau
retourné par getChoices de la classe enum correspondant.
