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
 *  (Direct) - view/content/team/homeindex.php
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
 * @variable obligatoire = $_POST['user_token']                         : type = text
 * 
 */
if(isset($_POST['invite_member'])){
    if(isset($_POST['user_token']) AND !empty($_POST['user_token'])){

        $user_token = htmlentities(addslashes($_POST['user_token']));
        $team_token = $router -> getRouteParam('2');

        if($user -> userExist($user_token) == true){
            $errors = $team -> inviteMember($user_token, $team_token, "Je t\'invite dans ma team Khoya");
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
 * 
 */
if(isset($_POST['create_team'])){
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['desc']) AND !empty($_POST['desc'])){

        $name = htmlentities(addslashes($_POST['name']));
        $desc = htmlentities(addslashes($_POST['desc']));

        $errors = $team -> createTeam($name, $desc);

    }else{
        $errors = ['success' => false, 'message' => ['text' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'dark', 'timeout' => 2000] ];
    }
}

// End of file
/******************************************************************************/
