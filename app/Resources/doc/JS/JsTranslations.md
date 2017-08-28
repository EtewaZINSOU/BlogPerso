# Traduction en JS

Pour utiliser les traductions Symfony depuis du code JS, dans la plus part des cas, l'objet `Translator` devrait être disponible (si votre fichier twig étends le `::layout.html.twig`).

Cet objet expose 2 méthodes qui sont utiles à la traduction:

```
Translator.trans('key.of.translation', {parameter: 'value'}, 'domain', 'locale');
Translator.transChoice('key.of.translation', count, {parameter: 'value'}, 'domain', 'locale');
```

Les arguments domain et locale sont rarement nécessaire sauf dans le cas d'elfinder.

**/!\ Petite précision**

Les parametres passés doivent être utilisés entre `%` dans la traduction:

```
// dans le js
Translator.trans('key', {count: 10});

// dans la traduction
key: J'ai %count% bananes
```

### ElFinder

Il est nécessaire de préciser le domain pour ElFinder, et pour certaines traductions il faut également préciser la locale:
```
elFinder.prototype.i18.en.messages['cmdshareFolder'] = Translator.trans('commands.share_folder.label', {}, 'elfinder', 'en');
elFinder.prototype.i18.fr.messages['cmdshareFolder'] = Translator.trans('commands.share_folder.label', {}, 'elfinder', 'fr');
```

### Domaines utilisés par le Translator

Par défaut, le translator cherche les clés de traduction dans le domaine `messages`.

Si, vos traductions sont dans un domaine différent, il sera nécessaire de dire au Translator de charger ces traductions.

Pour cela, il suffit d'ajouter dans votre fichier (souvent dans le block javascript) cette ligne:
```
{% block javascripts %}
# les js déjà présents

// cette ligne
<script src="{{ url('bazinga_jstranslation_js', {domain: 'LE_DOMAIN'}) }}"></script>
{% endblock %}
```

Vous pouvez avoir un exemple dans le fichier `drive.html.twig`, où les traductions spécfique à ElFinder sont chargées:

`<script src="{{ url('bazinga_jstranslation_js', {domain: 'elfinder'}) }}"></script>` 
