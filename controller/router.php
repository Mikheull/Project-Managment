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
        // Landings pages
        [ 'route' => 'home', 'dir_path' => 'view/landing/home/'],
        [ 'route' => 'pricing', 'dir_path' => 'view/landing/pricing/'],
        [ 'route' => 'features', 'dir_path' => 'view/landing/features/'],
        [ 'route' => 'contact', 'dir_path' => 'view/landing/contact/'],
        [ 'route' => 'download', 'dir_path' => 'view/landing/download/'],
        [ 'route' => 'twitter', 'dir_path' => 'view/landing/social/twitter/'],
        [ 'route' => 'github', 'dir_path' => 'view/landing/social/github/'],

        [ 'route' => 'developers', 'dir_path' => 'view/developers/'],
        
        // Help
        [ 'route' => 'help', 'dir_path' => 'view/help/home/'],
        [ 'route' => 'help/{{ARTICLE_NAME}}', 'dir_path' => 'view/help/article/'],

        // Legals
        [ 'route' => 'cgv', 'dir_path' => 'view/legals/cgv/'],
        [ 'route' => 'cgu', 'dir_path' => 'view/legals/cgu/'],
        [ 'route' => 'privacy-policy', 'dir_path' => 'view/legals/privacy-policy/'],
        [ 'route' => 'rgpd', 'dir_path' => 'view/legals/rgpd/'],
        [ 'route' => 'security', 'dir_path' => 'view/legals/security/'],

        // Authentication
        [ 'route' => 'login', 'dir_path' => 'view/auth/login/'],
        [ 'route' => 'logout', 'dir_path' => 'view/auth/logout/'],
        [ 'route' => 'register', 'dir_path' => 'view/auth/register/'],
        [ 'route' => 'reset-password', 'dir_path' => 'view/auth/reset-password/'],
        [ 'route' => 'new-password/{{USER_TOKEN}}/{{RESET_TOKEN}}', 'dir_path' => 'view/auth/new-password/'],


        // Members & Users
        [ 'route' => 'account', 'dir_path' => 'view/user/home/'],
        [ 'route' => 'account/teams', 'dir_path' => 'view/user/teams/'],
        [ 'route' => 'account/projects', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'account/followers', 'dir_path' => 'view/user/followers/'],
        [ 'route' => 'account/following', 'dir_path' => 'view/user/following/'],
        [ 'route' => 'account/settings', 'dir_path' => 'view/user/settings/'],

        [ 'route' => 'member', 'dir_path' => 'view/user/search/'],
        [ 'route' => 'member/{{USER_NAME}}', 'dir_path' => 'view/user/home/'],
        [ 'route' => 'member/{{USER_NAME}}/teams', 'dir_path' => 'view/user/teams/'],
        [ 'route' => 'member/{{USER_NAME}}/projects', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'member/{{USER_NAME}}/followers', 'dir_path' => 'view/user/followers/'],
        [ 'route' => 'member/{{USER_NAME}}/following', 'dir_path' => 'view/user/following/'],


        // Application
        [ 'route' => 'app', 'dir_path' => 'view/app/dashboard/'],
        
        [ 'route' => 'app/new-team', 'dir_path' => 'view/app/team/new/'],
        [ 'route' => 'app/team', 'dir_path' => 'view/app/team/select/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}', 'dir_path' => 'view/app/team/home/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/overview', 'dir_path' => 'view/app/team/overview/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/members', 'dir_path' => 'view/app/team/members/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/members/e/{{USER_TOKEN}}', 'dir_path' => 'view/app/team/members/edit/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/roles', 'dir_path' => 'view/app/team/roles/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/messenger', 'dir_path' => 'view/app/team/messenger/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/plugins', 'dir_path' => 'view/app/team/plugins/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/activity', 'dir_path' => 'view/app/team/activity/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/settings', 'dir_path' => 'view/app/team/settings/'],


        [ 'route' => 'app/new-project', 'dir_path' => 'view/app/project/new/'],
        [ 'route' => 'app/project', 'dir_path' => 'view/app/project/select/'],
        
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}', 'dir_path' => 'view/project/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/edit', 'dir_path' => 'view/project/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet', 'dir_path' => 'view/project/tools/gestion-projet/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/task/add', 'dir_path' => 'view/project/tools/gestion-projet/task-add/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/task/{{TASK_TOKEN}}/edit', 'dir_path' => 'view/project/tools/gestion-projet/task-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/export', 'dir_path' => 'view/project/tools/gestion-projet/export/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/stats', 'dir_path' => 'view/project/tools/gestion-projet/stats/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/reports', 'dir_path' => 'view/project/tools/gestion-projet/generator/reports/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/generator/gantt', 'dir_path' => 'view/project/tools/gestion-projet/generator/gantt/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe', 'dir_path' => 'view/project/tools/gestion-equipe/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/team/new', 'dir_path' => 'view/project/tools/gestion-equipe/team-new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/team/{{TEAM_TOKEN}}/edit', 'dir_path' => 'view/project/tools/gestion-equipe/team-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/roles', 'dir_path' => 'view/project/tools/gestion-equipe/roles/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/role/add', 'dir_path' => 'view/project/tools/gestion-equipe/role-add/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/role/{{ROLE_TOKEN}}/edit', 'dir_path' => 'view/project/tools/gestion-equipe/role-edit/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/messenger', 'dir_path' => 'view/project/tools/messenger/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/messenger/{{CONVERSATION_TOKEN}}', 'dir_path' => 'view/project/tools/messenger/conversation/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/calendar', 'dir_path' => 'view/project/tools/calendar/home/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml', 'dir_path' => 'view/project/tools/uml/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/import', 'dir_path' => 'view/project/tools/uml/import/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/create', 'dir_path' => 'view/project/tools/uml/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/{{UML_TOKEN}}/edit', 'dir_path' => 'view/project/tools/uml/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/export', 'dir_path' => 'view/project/tools/uml/export/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur', 'dir_path' => 'view/project/tools/recherche-utilisateur/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/new', 'dir_path' => 'view/project/tools/recherche-utilisateur/survey-new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{SURVEY_TOKEN}}/edit', 'dir_path' => 'view/project/tools/recherche-utilisateur/survey-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{SURVEY_TOKEN}}/stats', 'dir_path' => 'view/project/tools/recherche-utilisateur/survey-stats/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker', 'dir_path' => 'view/project/tools/bug-tracker/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/new', 'dir_path' => 'view/project/tools/bug-tracker/bug-new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/{{BUG_TOKEN}}/edit', 'dir_path' => 'view/project/tools/bug-tracker/bug-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/analyse', 'dir_path' => 'view/project/tools/bug-tracker/analyse/'],
        
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents', 'dir_path' => 'view/project/tools/documents/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/import', 'dir_path' => 'view/project/tools/documents/import/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/export', 'dir_path' => 'view/project/tools/documents/export/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/new', 'dir_path' => 'view/project/tools/documents/new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/{{DOCUMENTS_TOKEN}}/edit', 'dir_path' => 'view/project/tools/documents/edit/'],

    ]
);


// End of file
/******************************************************************************/
