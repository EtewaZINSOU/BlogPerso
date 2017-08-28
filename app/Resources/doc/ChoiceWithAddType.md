# ChoiceWithAddType

Ce form type permet de créer un select avec le choix de rentrer du texte 
ou de selectionner une valeur.

_C'est un override de `EntityType`._

Il requiert un certains nombre d'options à fournir obligatoirement:
```
->add('type', ChoiceWithAddType::class, [
    'class' => ContactRelationshipType::class,
    'label' => 'relationship.type.label',
    'query_builder' => function (EntityRepository $er) use ($options) {
        return $er->createQueryBuilder('t')
            ->where('t.lawFirm = :lawFirm')
            ->setParameter('lawFirm', $options['lawFirm']);
    },
    'choice_label' => function (ContactRelationshipType $value) {
        $translationKey = 'enum.value.'.$value->getLabel();
        if ($translationKey === $translation = $this->translator->trans($translationKey)) {
            return $value->getLabel();
        }

        return $translation;
    },
    'create_callback' => function (string $label) use ($options) {
        $newType = new ContactRelationshipType($options['lawFirm']);
        $newType->setLabel($label);

        return $newType;
    },
])
```

- `class` => la class que le selectize va mettre dans le select
- `label` => comme d'hab
- `query_builder` => permet de filtrer les choix à afficher à l'utilisateur (ici, on n'autorise que les `ContactRelationshipType` qui sont dans le même `LawFirm`)  (`query_builder` peut etre remplacer par `choices` ou rien)
- `choice_label` => la forme du label
- `create_callback` => fonction à éxécuter quand on ajoute une valeur dans le selectize (pas quand on en selectionne une existante)

## Important
La callback `create_callback` _**DOIT**_ retourner une entité.
