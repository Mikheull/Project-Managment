<?php


/**
 * Script de router
 * Il gère les méthodes relative a la class router
 * 
 * utilisé dans :
 *  (Config) - config.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$router = new router();



/**
 * Declaration des routes possible
 */
$router -> addRoutes(
    [
        [ 'route' => 'home', 'dir_path' => 'view/content/landing/home/'],
        [ 'route' => 'pricing', 'dir_path' => 'view/content/landing/pricing/'],
        [ 'route' => 'features', 'dir_path' => 'view/content/landing/features/'],
        [ 'route' => 'contact', 'dir_path' => 'view/content/landing/contact/'],
        [ 'route' => 'download', 'dir_path' => 'view/content/landing/download/'],
        [ 'route' => 'twitter', 'dir_path' => 'view/content/landing/social/twitter/'],
        [ 'route' => 'github', 'dir_path' => 'view/content/landing/social/github/'],

        [ 'route' => 'developers', 'dir_path' => 'view/content/developers/'],
        
        [ 'route' => 'help', 'dir_path' => 'view/content/help/home/'],
        [ 'route' => 'help/{{ARTICLE_NAME}}', 'dir_path' => 'view/content/help/article/'],

        [ 'route' => 'cgv', 'dir_path' => 'view/content/legals/cgv/'],
        [ 'route' => 'cgu', 'dir_path' => 'view/content/legals/cgu/'],
        [ 'route' => 'privacy-policy', 'dir_path' => 'view/content/legals/privacy-policy/'],
        [ 'route' => 'rgpd', 'dir_path' => 'view/content/legals/rgpd/'],
        [ 'route' => 'security', 'dir_path' => 'view/content/legals/security/'],

        [ 'route' => 'login', 'dir_path' => 'view/content/auth/login/'],
        [ 'route' => 'logout', 'dir_path' => 'view/content/auth/logout/'],
        [ 'route' => 'register', 'dir_path' => 'view/content/auth/register/'],
        [ 'route' => 'reset-password', 'dir_path' => 'view/content/auth/reset-password/'],
        [ 'route' => 'new-password/{{USER_TOKEN}}/{{RESET_TOKEN}}', 'dir_path' => 'view/content/auth/new-password/'],

        [ 'route' => 'account', 'dir_path' => 'view/content/account/home/'],
        [ 'route' => 'account/edit', 'dir_path' => 'view/content/account/edit/'],
        [ 'route' => 'account/teams', 'dir_path' => 'view/content/account/teams/'],
        [ 'route' => 'account/projects', 'dir_path' => 'view/content/account/projects/'],
        [ 'route' => 'account/followers', 'dir_path' => 'view/content/account/followers/'],
        [ 'route' => 'account/following', 'dir_path' => 'view/content/account/following/'],
        [ 'route' => 'account/settings', 'dir_path' => 'view/content/account/settings/'],

        [ 'route' => 'member', 'dir_path' => 'view/content/member/search/'],
        [ 'route' => 'member/{{USER_NAME}}', 'dir_path' => 'view/content/member/home/'],
        [ 'route' => 'member/{{USER_NAME}}/teams', 'dir_path' => 'view/content/member/teams/'],
        [ 'route' => 'member/{{USER_NAME}}/projects', 'dir_path' => 'view/content/member/projects/'],
        [ 'route' => 'member/{{USER_NAME}}/followers', 'dir_path' => 'view/content/member/followers/'],
        [ 'route' => 'member/{{USER_NAME}}/following', 'dir_path' => 'view/content/member/following/'],

        [ 'route' => 'team', 'dir_path' => 'view/content/team/home/'],
        [ 'route' => 'team/{{TEAM_TOKEN}}', 'dir_path' => 'view/content/team/dashboard/'],
        [ 'route' => 'team/{{TEAM_TOKEN}}/edit', 'dir_path' => 'view/content/team/edit/'],

        [ 'route' => 'app', 'dir_path' => 'view/content/project/new/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}', 'dir_path' => 'view/content/project/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/edit', 'dir_path' => 'view/content/project/edit/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet', 'dir_path' => 'view/content/project/tools/gestion-projet/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet/task/add', 'dir_path' => 'view/content/project/tools/gestion-projet/task-add/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet/task/{{TASK_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/gestion-projet/task-edit/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet/export', 'dir_path' => 'view/content/project/tools/gestion-projet/export/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet/stats', 'dir_path' => 'view/content/project/tools/gestion-projet/stats/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet/reports', 'dir_path' => 'view/content/project/tools/gestion-projet/generator/reports/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-projet/generator/gantt', 'dir_path' => 'view/content/project/tools/gestion-projet/generator/gantt/'],

        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-equipe', 'dir_path' => 'view/content/project/tools/gestion-equipe/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-equipe/team/new', 'dir_path' => 'view/content/project/tools/gestion-equipe/team-new/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-equipe/team/{{TEAM_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/gestion-equipe/team-edit/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-equipe/roles', 'dir_path' => 'view/content/project/tools/gestion-equipe/roles/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-equipe/role/add', 'dir_path' => 'view/content/project/tools/gestion-equipe/role-add/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/gestion-equipe/role/{{ROLE_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/gestion-equipe/role-edit/'],

        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/messenger', 'dir_path' => 'view/content/project/tools/messenger/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/messenger/{{CONVERSATION_TOKEN}}', 'dir_path' => 'view/content/project/tools/messenger/conversation/'],

        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/calendar', 'dir_path' => 'view/content/project/tools/calendar/home/'],

        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/uml', 'dir_path' => 'view/content/project/tools/uml/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/uml/import', 'dir_path' => 'view/content/project/tools/uml/import/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/uml/create', 'dir_path' => 'view/content/project/tools/uml/create/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/uml/{{UML_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/uml/edit/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/uml/export', 'dir_path' => 'view/content/project/tools/uml/export/'],

        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/recherche-utilisateur', 'dir_path' => 'view/content/project/tools/recherche-utilisateur/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/recherche-utilisateur/new', 'dir_path' => 'view/content/project/tools/recherche-utilisateur/survey-new/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{SURVEY_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/recherche-utilisateur/survey-edit/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{SURVEY_TOKEN}}/stats', 'dir_path' => 'view/content/project/tools/recherche-utilisateur/survey-stats/'],

        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/bug-tracker', 'dir_path' => 'view/content/project/tools/bug-tracker/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/bug-tracker/new', 'dir_path' => 'view/content/project/tools/bug-tracker/bug-new/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/bug-tracker/{{BUG_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/bug-tracker/bug-edit/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/bug-tracker/analyse', 'dir_path' => 'view/content/project/tools/bug-tracker/analyse/'],
        
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/documents', 'dir_path' => 'view/content/project/tools/documents/home/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/documents/import', 'dir_path' => 'view/content/project/tools/documents/import/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/documents/export', 'dir_path' => 'view/content/project/tools/documents/export/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/documents/new', 'dir_path' => 'view/content/project/tools/documents/new/'],
        [ 'route' => 'app/{{PROJECT_TOKEN}}/t/documents/{{DOCUMENTS_TOKEN}}/edit', 'dir_path' => 'view/content/project/tools/documents/edit/'],

    ]
);


// End of file
/******************************************************************************/
