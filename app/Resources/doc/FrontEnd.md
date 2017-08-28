# Automatiser le front-end dans un projet Symfony2

Dans tout projet Web, nous sommes confrontés à des tâches répétitives :

* Télécharger les différentes librairies ;
* Compiler les assets (Sass, Less, Stylus, CoffeeScript, TypeScript, …) ;
* Optimiser les images ;
* Gérer la concaténation des fichiers javascript, puis la minification ;
* Et beaucoup d’autres tâches…

# Définition des outils

#### Grunt

Développé en Javascript et executé par NodeJS, Grunt est utilisé par un large spectre de développeurs, et présente de réels atouts par rapport à Assetic.

A première vue, le fait qu'il n'y ait pas d'intégration directe à Symfony2 peut apparaitre comme un désavantage, mais ne pas coupler l'application Symfony2 à la configuration de votre gestionnaire de ressources vous permet une plus grande souplesse.

Note: pourquoi utiliser un gestionnaire de tâches ?

En un mot : L'automatisation. Moins vous avez de travail quand vous exécutez des tâches répétitives comme la minification, la compilation, les tests unitaires, le linting, etc, plus votre travail deviendra simple. Après l'avoir configuré, le gestionnaire de tâches peut faire la plupart du travail trivial pour vous et votre équipe sans aucun effort.

#### Bower

Développé et exécuté aussi par le couple Javascript/NodeJS, Bower est un gestionnaire de dépendances pour le développement front-end.

Pour faire une comparaison grossière, Bower est l'équivalent de Composer pour les librairies Javascript & CSS.