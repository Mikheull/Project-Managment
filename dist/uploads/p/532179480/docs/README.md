sql server :
    user : admin_improove
    pass : 7kp9PHKUAd

Page features :
    - https://codyhouse.co/gem/vertical-fixed-navigation

Création rapide tools :
    - https://codyhouse.co/gem/stretchy-navigation


Dropdown :
    - https://www.cssscript.com/demo/accessible-custom-dropdown-menu-dropmic/


calendrier :
    - https://codyhouse.co/ds/components/app/drawer
    - https://codyhouse.co/ds/components/app/off-canvas-content--full-width



codyhouse :
    - https://codyhouse.co/ds/components/content-and-layout
    - https://codyhouse.co/ds/components/app/text-divider
    - https://codyhouse.co/ds/components/app/card--link
    - https://codyhouse.co/ds/components/app/counter--docked
    - https://codyhouse.co/ds/components/app/avatar
    - https://codyhouse.co/ds/components/app/button-states

- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_toggle_password
Animations : 
- https://tobiasahlin.com/moving-letters/#
- https://loading.io/progress/
- https://loading.io/spinner/tail/-gooey-ball-tail-spinner
- https://codepen.io/SitePoint/pen/MYLoWY


## EU Privacy Summary (GDPR)

 
Lorsque vous utilisez un service proposé par Improove, nous récupérons quelques données de navigation et d'utilisation, aussi appelés "cookies".

## SQL_STRUCTURE 

**imp_user**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| username | Varchar | | Username de l'utilisateur |
| mail | Varchar | | Mail de l'utilisateur |
| password | Varchar | | Mot de passe |
| first_name | Varchar | NULL | Prénom de l'utilisateur |
| last_name | Varchar | NULL | Nom de famille de l'utilisateur |
| public_token | Varchar | | Token public |
| role | Int | 2 | Role de l'utilisateur |
| lang | Int | 1 | Identifiant de langue |
| date_join | DateTime | now | Date d'inscription |
| date_last_join | DateTime | now | Date de dernière connexion |
| enable | Boolean | true | Status du compte (actif - pas actif) |
 
<hr> 

**imp_role**
 
| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| ~~name~~ | ~~Varchar~~ | ~~NULL~~ | ~~Nom du role~~ |
| permissions | JSON | NULL | Liste de permissions |
| level | Int | 1 | Level du role |
| parent | Int | NULL | ID d'un parent |
| enable | Boolean | true | Status du role (actif - pas actif) |
  
<hr>

**imp_reset_password**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | %unique% | Token public de l'utilisateur |
| token | Varchar | %unique% | Token de la demande |
| date | DateTime | now | Date de la demande |
| enable | Boolean | true | Status de la demande (actif - pas actif) |

<hr>

**imp_licence**  

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token public de l'utilisateur |
| token | Varchar | %unique% | Token de la license |
| date_begin | DateTime | now | Date de début de souscription |
| date_end | DateTime | NULL | Date de fin de souscription |
| renew | Int | 0 | Nombre de renouvellement |
| enable | Boolean | true | Status de la demande (actif - pas actif) |
  
<hr>

**imp_follow**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| follower | Varchar | | Token public de l'utilisateur A |
| following | Varchar | | Token public de l'utilisateur B |
| date | DateTime | now | Date du follow |
| enable | Boolean | true | Status du follow (actif - pas actif) |
  
<hr>

**imp_blocked**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token public de l'utilisateur A |
| blocked_user_token | Varchar | | Token public de l'utilisateur B |
| date | DateTime | now | Date du bloquage |
| enable | Boolean | true | Status du bloquage (actif - pas actif) |

<hr>

**imp_newsletter**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| email | Varchar | | Email de l'utilisateur |
| date | DateTime | now | Date de l'inscription |
| enable | Boolean | true | Status de l'inscription (actif - pas actif) |

<hr>

**imp_notification**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token public de l'utilisateur qui reçois |
| date | DateTime | now | Date de la réponse |
| type | Varchar | | Type de la notification (follow ...) |
| content | Text | | Contenu de la notification |
| n_read | Boolean | false | Status du vue (true - false) |
| enable | Boolean | true | Status de la notification (actif - pas actif) |
  
<hr>

**pr_invitation_team**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token public de l'utilisateur |
| team_token | Varchar | | Token de la team |
| token | Varchar | %unique% | Token de l'invitation |
| date_begin | DateTime | now | Date de début de l'invitation |
| date_end | DateTime | NULL | Date de fin d'invitation |
| enable | Boolean | true | Status de l'invitation (actif - pas actif) |
  
<hr>

**pr_invitation_project**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token public de l'utilisateur |
| project_token | Varchar | | Token du projet |
| token | Varchar | %unique% | Token de l'invitation |
| date_begin | DateTime | now | Date de début de l'invitation |
| date_end | DateTime | NULL | Date de fin d'invitation |
| enable | Boolean | true | Status de l'invitation (actif - pas actif) |
  
<hr>

**pr_team**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| name | Varchar | | Nom de l'équipe |
| description | Varchar | now | Description de l'équipe |
| public_token | Varchar | | Token public de l'équipe |
| custom-url | Varchar | NULL | URL custom pour l'équipe |
| date_begin | Date | now | Date de création |
| public | Boolean | true | Public ou Privé (true - false) |
| founder_token | Varchar | | Token du créateur |
| enable | Boolean | true | Status de la team (actif - pas actif) |
 
<hr>

**pr_team_member**
 
| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token de l'utilisateur |
| team_token | Varchar | | Token de l'équipe |
| role | Int | 2 | Roles de l'utilisateur |
| date_joined | Date | now | Date d'arrivée |
| enable | Boolean | true | Status du membre (actif - pas actif) |
 
<hr>

**pr_team_role**  

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| team_token | Varchar | | Token de l'équipe |
| name | Varchar | | Nom du role |
| role_token | Varchar(30) | | Token du role (1039131919391338318 ...) |
| permissions | Text | | Permissions pour le role |
| color | Varchar(6) | 394165 | Couleur du role |
| date | Date | now | Date de création |
| enable | Boolean | true | Status du role (actif - pas actif) |

<hr>

**imp_permission**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| permission | %unique% | | permission |
  
<hr>

**pr_project**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| name | Varchar | | Nom du projet |
| description | Varchar | now | Description du projet |
| public_token | Varchar | | Token public du projet |
| custom-url | Varchar | NULL | URL custom pour le projet |
| date_begin | Date | now | Date de création |
| public | Boolean | true | Public ou Privé (true - false) |
| founder_token | Varchar | | Token du créateur |
| enable | Boolean | true | Status du projet (actif - pas actif) |
 

<hr>

**pr_project_member**
 
| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar | | Token de l'utilisateur |
| team_token | Varchar | | Token du projet |
| role | Int | 2 | Roles de l'utilisateur |
| date_joined | Date | now | Date d'arrivée |
| enable | Boolean | true | Status du membre (actif - pas actif) |
 
<hr>
