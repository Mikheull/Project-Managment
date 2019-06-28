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
$router = new router($db);



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
        [ 'route' => 'open-source', 'dir_path' => 'view/landing/open-source/'],
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

        [ 'route' => 'member/{{USER_NAME}}', 'dir_path' => 'view/user/home/'],
        [ 'route' => 'member/{{USER_NAME}}/teams', 'dir_path' => 'view/user/teams/'],
        [ 'route' => 'member/{{USER_NAME}}/projects', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'member/{{USER_NAME}}/followers', 'dir_path' => 'view/user/followers/'],
        [ 'route' => 'member/{{USER_NAME}}/following', 'dir_path' => 'view/user/following/'],

        // Members & Users
        [ 'route' => 'search', 'dir_path' => 'view/landing/search/'],
        [ 'route' => 'search/teams', 'dir_path' => 'view/landing/search/teams/'],
        [ 'route' => 'search/projects', 'dir_path' => 'view/landing/search/projects/'],

        // Application
        [ 'route' => 'app', 'dir_path' => 'view/app/hub/'],
        [ 'route' => 'app/new/project', 'dir_path' => 'view/app/project/new/'],
        [ 'route' => 'app/new/team', 'dir_path' => 'view/app/team/new/'],
        [ 'route' => 'app/join/project/{{PROJECT_TOKEN}}', 'dir_path' => 'view/app/project/join/'],
        [ 'route' => 'app/join/team/{{TEAM_TOKEN}}', 'dir_path' => 'view/app/team/join/'],
        
        
        [ 'route' => 'app/team', 'dir_path' => 'view/app/team/hub/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}', 'dir_path' => 'view/app/team/home/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/members', 'dir_path' => 'view/app/team/members/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/members/{{USER_TOKEN}}/activity', 'dir_path' => 'view/app/team/members/activity/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/members/{{USER_TOKEN}}/edit', 'dir_path' => 'view/app/team/members/edit/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/messenger', 'dir_path' => 'view/app/team/messenger/'],
        [ 'route' => 'app/team/{{TEAM_TOKEN}}/settings', 'dir_path' => 'view/app/team/settings/'],


        [ 'route' => 'app/project', 'dir_path' => 'view/app/project/hub/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}', 'dir_path' => 'view/app/project/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/settings', 'dir_path' => 'view/app/project/settings/'],
        
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet', 'dir_path' => 'view/app/project/tools/gestion-projet/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/reports', 'dir_path' => 'view/app/project/tools/gestion-projet/reports/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/gantt', 'dir_path' => 'view/app/project/tools/gestion-projet/gantt/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe', 'dir_path' => 'view/app/project/tools/gestion-equipe/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/team', 'dir_path' => 'view/app/project/tools/gestion-equipe/team/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/team/{{TEAM_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/gestion-equipe/team/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/members', 'dir_path' => 'view/app/project/tools/gestion-equipe/members/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/members/{{USER_TOKEN}}/activity', 'dir_path' => 'view/app/project/tools/gestion-equipe/members/activity/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/members/{{USER_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/gestion-equipe/members/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/settings', 'dir_path' => 'view/app/project/tools/gestion-equipe/settings/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/messenger', 'dir_path' => 'view/app/project/tools/messenger/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/messenger/{{CONVERSATION_TOKEN}}', 'dir_path' => 'view/app/project/tools/messenger/conv/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/calendar', 'dir_path' => 'view/app/project/tools/calendar/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/calendar/settings', 'dir_path' => 'view/app/project/tools/calendar/settings/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml', 'dir_path' => 'view/app/project/tools/uml/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/import', 'dir_path' => 'view/app/project/tools/uml/import/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/create', 'dir_path' => 'view/app/project/tools/uml/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/{{UML_TOKEN}}', 'dir_path' => 'view/app/project/tools/uml/view/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/new', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/survey-new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{SURVEY_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/survey-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{SURVEY_TOKEN}}/stats', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/survey-stats/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker', 'dir_path' => 'view/app/project/tools/bug-tracker/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/new', 'dir_path' => 'view/app/project/tools/bug-tracker/bug-new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/{{BUG_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/bug-tracker/bug-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/analyse', 'dir_path' => 'view/app/project/tools/bug-tracker/analyse/'],
        
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents', 'dir_path' => 'view/app/project/tools/documents/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/import', 'dir_path' => 'view/app/project/tools/documents/import/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/export', 'dir_path' => 'view/app/project/tools/documents/export/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/new', 'dir_path' => 'view/app/project/tools/documents/new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/{{DOCUMENTS_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/documents/edit/'],

    ]
);


// End of file
/******************************************************************************/
