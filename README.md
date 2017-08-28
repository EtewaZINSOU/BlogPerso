Symfony Standard Edition
========================

Welcome to the Symfony Standard Edition - a fully-functional Symfony
application that you can use as the skeleton for your new applications.

For details on how to download and get started with Symfony, see the
[Installation][1] chapter of the Symfony Documentation.

What's inside?
--------------

The Symfony Standard Edition is configured with the following defaults:

  * An AppBundle you can use to start coding;

  * Twig as the only configured template engine;

  * Doctrine ORM/DBAL;

  * Swiftmailer;

  * Annotations enabled for everything.

It comes pre-configured with the following bundles:

  * **FrameworkBundle** - The core Symfony framework bundle

  * [**SensioFrameworkExtraBundle**][6] - Adds several enhancements, including
    template and routing annotation capability

  * [**DoctrineBundle**][7] - Adds support for the Doctrine ORM

  * [**TwigBundle**][8] - Adds support for the Twig templating engine

  * [**SecurityBundle**][9] - Adds security by integrating Symfony's security
    component

  * [**SwiftmailerBundle**][10] - Adds support for Swiftmailer, a library for
    sending emails

  * [**MonologBundle**][11] - Adds support for Monolog, a logging library

  * **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
    the web debug toolbar

  * **SensioDistributionBundle** (in dev/test env) - Adds functionality for
    configuring and working with Symfony distributions

  * [**SensioGeneratorBundle**][13] (in dev env) - Adds code generation
    capabilities

  * [**WebServerBundle**][14] (in dev env) - Adds commands for running applications
    using the PHP built-in web server

  * **DebugBundle** (in dev/test env) - Adds Debug and VarDumper component
    integration

All libraries and bundles included in the Symfony Standard Edition are
released under the MIT or BSD license.

Enjoy!

[1]:  https://symfony.com/doc/3.3/setup.html
[6]:  https://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html
[7]:  https://symfony.com/doc/3.3/doctrine.html
[8]:  https://symfony.com/doc/3.3/templating.html
[9]:  https://symfony.com/doc/3.3/security.html
[10]: https://symfony.com/doc/3.3/email.html
[11]: https://symfony.com/doc/3.3/logging.html
[13]: https://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html
[14]: https://symfony.com/doc/current/setup/built_in_web_server.html




# BlogPerso

Welcome to the source code of the BlogPerso web application.  

La documentation, en français, est stockée dans `app/Resources/doc`. Elle est à maintenir avec le code !
[Voir sur Github](https://github.com/EtewaZINSOU/BlogPerso/tree/master/app/Resources/doc)

Les documents indispensables à lire :
 * [Setup](app/Resources/doc/Setup.md)
 * [Quick start](app/Resources/doc/Quickstart.md)
 * [Testing](app/Resources/doc/Testing.md)
 * [Coding style](app/Resources/doc/CodingStyle.md)
 * [How to PR](app/Resources/doc/PR.md)
 
Documents de référence :
 * [Conception](app/Resources/doc/Conception.md)
 * [Command]((app/Resources/doc/Command.md))
 * [API doc (en local)](http://jarvis.local:8080/app_dev.php/api/doc)

Documents sur les parties techniques un peu avancées :
 * [Doctrine Migration](app/Resources/doc/Migration.md)
 * [Évènements métier](app/Resources/doc/Events.md)
 * [Bus de commande](app/Resources/doc/CommandBus.md)
 * [Webmail AfterLogic](app/Resources/doc/Webmail.md)
 * [Selectize avec entrée libre](app/Resources/doc/ChoiceWithAddType.md)
 * Javascript :
   * [Inclure des dépendences](app/Resources/doc/JS/GulpInclude.md)
   * [LazyInclude et LazyIframe](app/Resources/doc/JS/LazyInclude.md)
   * [LazyLoad](app/Resources/doc/JS/LazyLoad.md)
   * [Traduction](app/Resources/doc/JS/JsTranslations.md)
 * Modal
   * [Comment ajouter une modal](app/Resources/doc/Modal/Usage.md)
   * [Modal avant suppression](app/Resources/doc/Modal/ModalBeforeDelete.md)
 * Editeur Wysiwyg
   * [Usage](app/Resources/doc/Tinymce/Usage.md)
