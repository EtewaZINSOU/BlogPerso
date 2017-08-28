# Avoir une modal pour confirmer une suppression

Une modal est accessible partout dans le site (disponible dans `layout.html.twig`)

##Usage :

Pour avoir cette modal, plusieurs étapes sont nécessaires:

- Ajouter des `data` sur le lien/bouton de suppression
    - `data-link`: l'url de suppression de l'objet
    - `data-object`: le nom de l'objet, qui servira pour la traduction dans le message de la modal
    - `data-toggle="confirm"`: Un event js est positionné dessus pour afficher la modal
- Mettre `href="#"`, c'est le `data-link` qui prendra le relais

Dans le cas d'un Row/RowAction, il faut simplement préciser le 3e parametre `confirm` à true :
`$rowAction = new RowAction('Supprimer', 'route_delete', true);`

Cette façon de faire est aujourd'hui utilisé lors d'une suppression d'un dossier/contact/organisation.

##Avancé :

Si vous souhaitez:
- définir des actions spécifiques en Javascript une fois que l'utilisateur
a cliqué sur `Oui`
- définir un message personnalisé propre à votre action

vous pouvez configurer de la sorte:

- Ajouter des `data` sur le lien/bouton de votre action :
    - `data-message`: la clé de traduction
    - `data-event`: l'évènement déclaré en Javascript sur lequel votre action doit être associé

/!\ Dans ce cas précis, vous n'avez pas besoin de préciser `data-toggle="confirm"`

Cas pratique: sur le formulaire d'un matter, nous souhaitons supprimer en masse un nombre importants de dossier.
Pour cela, nous avons besoin de cocher les lignes en question et cliquer sur "Actions > Supprimer".

1. Le lien/bouton sera :
```
<a
    data-message="generic.confirmation.message.matters"
    data-event="mass-action-delete"
    id="mass-action-delete"
    href="#">{{ "generic.delete"|trans }}</a>
```

2. L'appel à la modal personnalisé :
```
$('#mass-action-delete').on('click', function (e) {
    e.preventDefault();

    $('[data-toggle="confirm"]').trigger('confirm-advanced', [$(this)]);
});
```

3. Les actions spécifiques associées à l'évènement :
```
$(document).on('mass-action-delete', function () {
    // execute your best script ever
});
```
