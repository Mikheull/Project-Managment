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
        [ 'route' => 'twitter', 'dir_path' => 'view/landing/social/twitter/', 'rendering_html' => false],
        [ 'route' => 'github', 'dir_path' => 'view/landing/social/github/', 'rendering_html' => false],

        [ 'route' => 'developers', 'dir_path' => 'view/developers/'],
        
        // Demo
        [ 'route' => 'demo', 'dir_path' => 'view/demo/home/'],
        [ 'route' => 'demo/@improove', 'dir_path' => 'view/demo/improove/'],
        [ 'route' => 'demo/@team', 'dir_path' => 'view/demo/team/'],
        [ 'route' => 'demo/@project', 'dir_path' => 'view/demo/project/'],
        [ 'route' => 'demo/@me', 'dir_path' => 'view/demo/account/'],

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
        [ 'route' => 'account', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'account/projects', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'account/followers', 'dir_path' => 'view/user/followers/'],
        [ 'route' => 'account/following', 'dir_path' => 'view/user/following/'],
        [ 'route' => 'account/settings', 'dir_path' => 'view/user/settings/'],
        [ 'route' => 'account/my-data', 'dir_path' => 'view/user/my-data/', 'rendering_html' => false],

        [ 'route' => 'member/{{USER_NAME}}', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'member/{{USER_NAME}}/projects', 'dir_path' => 'view/user/projects/'],
        [ 'route' => 'member/{{USER_NAME}}/followers', 'dir_path' => 'view/user/followers/'],
        [ 'route' => 'member/{{USER_NAME}}/following', 'dir_path' => 'view/user/following/'],

        // Recherche
        [ 'route' => 'search', 'dir_path' => 'view/landing/search/'],
        [ 'route' => 'search/projects', 'dir_path' => 'view/landing/search/projects/'],

        // Application
        [ 'route' => 'sharing/{{TOKEN}}', 'dir_path' => 'view/app/sharing/'],
        [ 'route' => 'affinity-diagram/{{TOKEN}}', 'dir_path' => 'view/app/ur/affinity-diagram/'],
        [ 'route' => 'survey/{{TOKEN}}', 'dir_path' => 'view/app/ur/survey/'],

        [ 'route' => 'app', 'dir_path' => 'view/app/hub/'],
        [ 'route' => 'app/new/project', 'dir_path' => 'view/app/project/new/'],
        [ 'route' => 'app/join/project/{{PROJECT_TOKEN}}', 'dir_path' => 'view/app/project/join/'],


        [ 'route' => 'app/project/{{PROJECT_TOKEN}}', 'dir_path' => 'view/app/project/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/settings', 'dir_path' => 'view/app/project/settings/'],
        
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet', 'dir_path' => 'view/app/project/tools/gestion-projet/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/export/{{TAB_TOKEN}}', 'dir_path' => 'view/app/project/tools/gestion-projet/export/', 'rendering_html' => false],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/reports', 'dir_path' => 'view/app/project/tools/gestion-projet/reports/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-projet/gantt', 'dir_path' => 'view/app/project/tools/gestion-projet/gantt/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe', 'dir_path' => 'view/app/project/tools/gestion-equipe/team/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/team/create', 'dir_path' => 'view/app/project/tools/gestion-equipe/team/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/team/{{TEAM_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/gestion-equipe/team/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/members', 'dir_path' => 'view/app/project/tools/gestion-equipe/members/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/members/{{USER_TOKEN}}/activity', 'dir_path' => 'view/app/project/tools/gestion-equipe/members/activity/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/gestion-equipe/members/{{USER_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/gestion-equipe/members/edit/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/messenger', 'dir_path' => 'view/app/project/tools/messenger/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/messenger/{{CONVERSATION_TOKEN}}', 'dir_path' => 'view/app/project/tools/messenger/channel/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/calendar', 'dir_path' => 'view/app/project/tools/calendar/home/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml', 'dir_path' => 'view/app/project/tools/uml/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/import', 'dir_path' => 'view/app/project/tools/uml/import/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/create', 'dir_path' => 'view/app/project/tools/uml/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/{{UML_TOKEN}}', 'dir_path' => 'view/app/project/tools/uml/view/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/uml/{{UML_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/uml/edit/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/create', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/view/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/affinity-diagram/create', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/affinity-diagram/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/affinity-diagram/{{TOKEN}}', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/affinity-diagram/view/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/affinity-diagram/{{TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/affinity-diagram/view/edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/survey/create', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/survey/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/survey/{{TOKEN}}', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/survey/view/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/recherche-utilisateur/{{TOKEN}}/report', 'dir_path' => 'view/app/project/tools/recherche-utilisateur/report/'],

        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker', 'dir_path' => 'view/app/project/tools/bug-tracker/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/new', 'dir_path' => 'view/app/project/tools/bug-tracker/bug-new/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/{{BUG_TOKEN}}/edit', 'dir_path' => 'view/app/project/tools/bug-tracker/bug-edit/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/bug-tracker/reports', 'dir_path' => 'view/app/project/tools/bug-tracker/reports/'],
        
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents', 'dir_path' => 'view/app/project/tools/documents/home/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/share', 'dir_path' => 'view/app/project/tools/documents/share/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/import', 'dir_path' => 'view/app/project/tools/documents/import/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/create', 'dir_path' => 'view/app/project/tools/documents/create/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/viewer', 'dir_path' => 'view/app/project/tools/documents/view/'],
        [ 'route' => 'app/project/{{PROJECT_TOKEN}}/t/documents/edit', 'dir_path' => 'view/app/project/tools/documents/edit/'],

    ]
);


// End of file
/******************************************************************************/
