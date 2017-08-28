# Entités - User
 
 
## `User` / Intervenant

Les `User` sont les utilisateurs de l'application, qui peuvent se connecter dessus.  
Pour nos clients, on peut parler "d'intervenants" (niveau de permission `ROLE_USER`).
Un certain nombre de données sont cloisonnées par intervenant.

Au délà, il y aura quelques utilisateurs `ROLE_SUPER_ADMIN`, correspondant à des personnes de chez qui peut gérer l'administration du site

Propriétés:
 * `id`
 * `pusherId` l'ID utilisé pour le notifier via Pusher
 * `legacyId` l'ID de cet utilisateur dans la V1 (s'il a été importé)
 * `username`
 * `firstname` et `lastname`
 * `email` les utilisateurs peuvent se connecter avec leur nom d'utilisateur ou leur adresse e-mail
 * `password`
 * `language`: stocke présentement la langue sélectionnée dans la V1 
 * `jobTitle` la profession de l'utilisateur
 * `filePath` hérité par HasUploadedFileTrait - logo/photo



