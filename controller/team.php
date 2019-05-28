<?php


/**
 * Script des équipes
 * Il gère les méthodes relative a la class team
 * 
 * utilisé dans :
 *  (Direct) - view/content/account/teams/components/card.php
 *  (Direct) - view/content/account/teams/components/invitation.php
 *  (Direct) - view/content/account/teams/index.php
 *  (Direct) - view/content/member/teams/components/card.php
 *  (Direct) - view/content/member/teams/index.php
 *  (Direct) - view/content/team/dashboard/index.php
 *  (Direct) - view/content/team/edit/index.php
 *  (Direct) - view/content/team/home/components/home.php
 *  (Direct) - view/content/team/home/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$team = new team($db);



/**
 * Formulaire pour rejoindre une équipe via le modal
 * 
 * @fichier d'execution = view/content/account/teams/index.php
 * @variable d'execution = $_POST['project_token']                      : type = button
 * 
 */
if(isset($_POST['project_token'])){
    $project_token = htmlentities(addslashes($_POST['project_token']));

    $errors = $team -> joinTeam( $project_token, $main -> getToken() );
}



/**
 * Formulaire pour accepter une demande
 * 
 * @fichier d'execution = view/content/account/teams/components/invitation.php
 * @variable d'execution = $_POST['accept_invitation']                  : type = button
 * 
 * @variable obligatoire = $_POST['invitation']                         : type = text
 * 
 */
if(isset($_POST['accept_invitation'])){
    $project_token = htmlentities(addslashes($_POST['invitation']));

    $errors = $team -> setInvitationAnswer($project_token, $main -> getToken(), 'accept');
}



/**
 * Formulaire pour refuser une demande
 * 
 * @fichier d'execution = view/content/account/teams/components/invitation.php
 * @variable d'execution = $_POST['decline_invitation']                  : type = button
 * 
 * @variable obligatoire = $_POST['invitation']                         : type = text
 * 
 */
if(isset($_POST['decline_invitation'])){
    $project_token = htmlentities(addslashes($_POST['invitation']));

    $errors = $team -> setInvitationAnswer($project_token, $main -> getToken(), 'decline');
}




/**
 * Formulaire pour inviter un membre dans une équipe
 * 
 * @fichier d'execution = view/content/app/team/members/components/home.php
 * @variable d'execution = $_POST['invite_member']                      : type = button
 * 
 * @variable obligatoire = $_POST['user_mail']                          : type = mail
 * 
 */
if(isset($_POST['invite_member'])){
    if(isset($_POST['user_mail']) AND !empty($_POST['user_mail'])){

        $user_mail = htmlentities(addslashes($_POST['user_mail']));
        if(isset($_POST['team_token']) AND !empty($_POST['team_token'])){
            $team_token = htmlentities(addslashes($_POST['team_token']));
        }else{
            $team_token = $router -> getRouteParam('2');
        }

        if($auth -> emailExist($user_mail) == true){
            $errors = $team -> inviteMember($user_mail, $team_token, "Je t\'invite dans ma team Khoya");
        }else{
            $errors = ['success' => false, 'message' => ['text' => "L\'utilisateur n\'existe pas !", 'theme' => 'dark', 'timeout' => 2000] ];
        }

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'dark', 'timeout' => 2000] ];
    }
}



/**
 * Formulaire pour Créer une team
 * 
 * @fichier d'execution = view/content/app/team/new/index.php
 * @variable d'execution = $_POST['create_team']                        : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['desc']                               : type = text
 * @variable obligatoire = $_POST['status']                             : type = radio
 * 
 */
if(isset($_POST['create_team'])){
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['desc']) AND !empty($_POST['desc']) AND isset($_POST['status']) AND !empty($_POST['status'])){

        $name = htmlentities(addslashes($_POST['name']));
        $desc = htmlentities(addslashes($_POST['desc']));
        $status = htmlentities(addslashes($_POST['status']));

        $errors = $team -> createTeam($name, $desc, $status);

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'dark', 'timeout' => 2000] ];
    }
}

// End of file
/******************************************************************************/
