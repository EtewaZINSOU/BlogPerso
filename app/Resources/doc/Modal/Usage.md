# Mise en place d'une modal

### Usage:

Pour obtenir cette modal, plusieurs étapes sont nécessaires :

* Ajouter un lien permettant l'accès à cette modal, exemple :

```
# __ROUTE__ correspond à l'action du controlleur qui construit votre formulaire

# la version avec un <a>
<a href="{{ path(__ROUTE__) }}" target="_self" data-toggle="modal-form">__TEXTE__</a>

# la version avec un <button>
<button type="button" class="btn btn-primary" data-toggle="modal-form" data-href="{{ path(__ROUTE__) }}">__TEXTE__</button>
```
* Copier coller le contenu suivant dans votre page:
```
    <div class="modal fade" data-modal="true" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"></div>
        </div>
    </div>
```
* Dans la section `{% block javascripts %}`, copier coller le code suivant:
```
<script src="{{ asset('bundles/common/js/ModalForm.js') }}"></script>
```
