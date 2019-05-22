## SQL_STRUCTURE

**imp_user**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| username | Varchar |  | Username de l'utilisateur |
| mail | Varchar |  | Mail de l'utilisateur |
| password | Varchar |  | Mot de passe |
| first_name | Varchar | NULL | Prénom de l'utilisateur |
| last_name | Varchar | NULL | Nom de famille de l'utilisateur |
| public_token | Varchar |  | Token public |
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
| user_public_token | Varchar |  | Token public de l'utilisateur |
| token | Varchar | %unique% | Token de la license |
| date_begin | DateTime | now | Date de début de souscription |
| date_end | DateTime | NULL | Date de fin de souscription |
| renew | Int | 0 | Nombre de renouvellement |
| enable | Boolean | true | Status de la demande (actif - pas actif) |

<hr>

**pr_invitation_team**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar |  | Token public de l'utilisateur |
| team_token | Varchar |  | Token de la team |
| token | Varchar | %unique% | Token de l'invitation |
| date_begin | DateTime | now | Date de début de l'invitation |
| date_end | DateTime | NULL | Date de fin d'invitation |
| enable | Boolean | true | Status de l'invitation (actif - pas actif) |

<hr>

**pr_invitation_project**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_public_token | Varchar |  | Token public de l'utilisateur |
| project_token | Varchar |  | Token du projet |
| token | Varchar | %unique% | Token de l'invitation |
| date_begin | DateTime | now | Date de début de l'invitation |
| date_end | DateTime | NULL | Date de fin d'invitation |
| enable | Boolean | true | Status de l'invitation (actif - pas actif) |

<hr>

**imp_friend**

| nom | type | défaut | explications
|--|--|--|--|
| ID | Int | %auto-increment% | ID unique |
| user_token_a | Varchar |  | Token public de l'utilisateur A |
| user_token_b | Varchar |  | Token public de l'utilisateur B |
| date_begin | DateTime | now | Date de la demande |
| date_end | DateTime | NULL | Date de la réponse |
| enable | Boolean | true | Status de la demande (1 = pending / 2 = ami) |


## URL_STRUCTURE

| nom | url
|--|--|
| accueil | / |
| pricing | /pricing |
| features | /features |
| contact | /contact |
| contact avec paramètre | /contact?for=details |
| download | /download |
| developers | /developers |
| help | /help |
| article d'aide | /help/Article-unique-name |
| CGV | /cgv |
| CGU | /cgu |
| privacy-policy | /privacy-policy |
| rgpd | /rgpd |
| security | /security |
| login | /login |
| login avec paramètre | /login?return_url=pricing |
| logout | /logout |
| register | /register |
| reset-password | /reset-password |
| new-password | /new-password/user-token/reset-token |
| account | /account |
| account/edit | account/edit |
