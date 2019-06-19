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
            $errors = ['success' => false, 'options' => ['content' => "L\'utilisateur n\'existe pas !", 'theme' => 'error'] ];
        }

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
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
        $invitations = $_POST['mails_list'];

        $errors = $team -> createTeam($name, $desc, $status, $invitations);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}

if(isset( $_POST['remove_member'] )){

    if($team -> teamExist( $_POST['team_token'] ) == true){
        if($utils -> getData('pr_team', 'founder_token', 'public_token', $_POST['team_token']) !== $_POST['user_token']){
            $errors = $team -> kickMember($_POST['team_token'], $_POST['user_token']);
            $utils -> addlog($main -> getToken(),  $_POST['team_token'], 'pr_team_member', 'team-kick', ['user_kicked' => $_POST['user_token']]);

        }else{
            $errors = ['success' => false, 'options' => ['content' => "Vous ne pouvez pas retirer le fondateur, transferez les droits avant !", 'theme' => 'error'] ];
        }
    }else{
        $errors = ['success' => false, 'options' => ['content' => "L\'équipe n\'existe pas !", 'theme' => 'error'] ];
    }
    
}


/**
 * Formulaire pour editer les informations d'une équipe
 * 
 * @fichier d'execution = view/content/app/team/settings/index.php
 * @variable d'execution = $_POST['update_team_infos']                  : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['desc']                               : type = text
 * @variable obligatoire = $_POST['status']                             : type = text
 * 
 */
if(isset($_POST['update_team_infos'])){
    
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['desc']) AND !empty($_POST['desc']) AND isset($_POST['status']) AND !empty($_POST['status'])){
        $name = htmlentities(addslashes($_POST['name']));
        $desc = htmlentities( addslashes($_POST['desc']));
        
        $_POST['status'] == 'private' ? $status = 0 : $status = 1;
        $team_token = $router -> getRouteParam('2');

        if(strlen($desc) <= 255){
            $errors = $team -> editTeamInfos($name, $desc, $status, $team_token);
            $utils -> addlog($main -> getToken(), $team_token, 'pr_team', 'team-edit-settings');
        }else{
            $errors = ['success' => false, 'options' => ['content' => "La description est trop longue (".strlen($bio)."/255) !", 'theme' => 'error'] ];
        }

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs ", 'theme' => 'error'] ];
    }

}

// End of file
/******************************************************************************/
