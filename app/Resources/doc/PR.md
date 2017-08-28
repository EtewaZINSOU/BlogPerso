# Critères pour une PR parfaite

Nous fonctionnons en PR sur [Github](https://github.com/EtewaZINSOU/BlogPerso) pour l'ensemble des modifications.

Les critères pour qu'une PR soit mergée rapidemment sont :
 * code fini :)
 * guide de style respecté :
  * respect des règles du [Coding style](CodingStyle.md)
 * documentation :
  * si vous avez modifié des entités, mettez à jour la documentation de [conception](Conception.md)
  * toute API doit être documentée (via les annotations)
 * migrations :
  * si le schéma de la BDD a changé, générez une migration Doctrine, cf [Doctrine Migration](Migration.md)

Si un conflit empêche le merge, on mettra un label "to rebase" sur votre PR. 
Vous devrez alors metre à jour `develop` chez vous, sur votre branche faire `git rebase develop` et régler les conflits.
