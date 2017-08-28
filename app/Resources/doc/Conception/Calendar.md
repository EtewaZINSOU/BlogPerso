# Entités - Calendar

## `Calendar` / Calendrier

Un `Calendar` est un calendrier relié à un utilisateur.
Un utilisateur peut avoir plusieurs calendriers dans son agenda. Il en a au minimum un, qui porte son nom (et qui est "par défaut" pour lui).
 
Un calendrier peut être rattaché à un `owner`, un intervenant à qui il appartient, auquel cas celui-ci choisit avec qui il le partage (via `shareUsers`).
S'il n'a pas d'`owner`, alors il appartient au `lawFirm` c'est--dire qu'il est accessible par tous les utilisateurs du cabinet.
Chaque cabinet a un calendrier par défaut, partagé à tous ses collaborateurs.

Propriétés:
 * `id`
 * `name` nom (obligatoire) du calendrier (unique par rapport à cet utilisateur)
 * `color` nom de la couleur de ce calendrier (par défaut "`red`")
 * `lawFirm` cabinet (toujours renseigné)
 * `owner` utilisateur `User` à qui il appartient, ou `null`
 * `sharedUsers` dans le cas où il a un `owner`, utilisateurs avec qui il est partagé (vide sinon)
 * `events` tableau des évènements qui sont dans ce calendrier
 * `isDefault` booléen indiquant si ce calendrier est par défaut, auquel cas il n'est pas supprimable ni son nom éditable.
 
## `CalendarEvent` / Évènement

Un `CalendarEvent` est un évènement présent dans (exactement) un calendrier.
Il peut être lié (ou pas) à un `Matter`.

Propriétés:
 * `id`
 * `name` nom (obligatoire)
 * `calendar` le calendrier auquel il appartient (obligatoire)
 * `matter` optionnellement un `Matter` lié
 * `location` champ libre (non obligatoire) sur le lieu de l'évènement
 * `start` la date(time) de début
 * `end` la date(time) de fin
 * `fullDay` booléen indiquant si l'évènement est un/des jour(s) complet(s)
 
Règles métier :
 * `start`, `end` et `fullDay` sont toujours renseignés
 * `fullDay` à `true` indique que l'évènement est une ou des journées entières. Dans ce cas, les heures de `start` et `end` peuvent être à n'importe quelle valeur.
 * si `fullDay` est `false`, alors `end` est strictement postérieur à `start`
