<?php


/**
 * Script des équipes
 * Il gère les méthodes relative a la class project
 * 
 * utilisé dans :
 *  (Direct) - view/app/project/hub/index.php
 *  (Direct) - view/app/project/new/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$project = new project($db);



/**
 * Formulaire pour accepter une demande
 * 
 * @fichier d'execution = view/content/account/project/components/invitation.php
 * @variable d'execution = $_POST['accept_invitation']                  : type = button
 * 
 * @variable obligatoire = $_POST['invitation']                         : type = text
 * 
 */
if(isset($_POST['accept_invitation'])){
    $project_token = htmlentities(addslashes($_POST['invitation']));

    $errors = $project -> setInvitationAnswer($project_token, $main -> getToken(), 'accept');
}



/**
 * Formulaire pour refuser une demande
 * 
 * @fichier d'execution = view/content/account/project/components/invitation.php
 * @variable d'execution = $_POST['decline_invitation']                 : type = button
 * 
 * @variable obligatoire = $_POST['invitation']                         : type = text
 * 
 */
if(isset($_POST['decline_invitation'])){
    $project_token = htmlentities(addslashes($_POST['invitation']));

    $errors = $project -> setInvitationAnswer($project_token, $main -> getToken(), 'decline');
}



/**
 * Formulaire pour inviter un membre dans un projet
 * 
 * @fichier d'execution = view/content/app/project/members/components/home.php
 * @variable d'execution = $_POST['invite_member']                      : type = button
 * 
 * @variable obligatoire = $_POST['user_mail']                          : type = mail
 * 
 */
if(isset($_POST['invite_member'])){
    if(isset($_POST['user_mail']) AND !empty($_POST['user_mail'])){

        $user_mail = htmlentities(addslashes($_POST['user_mail']));
        if(isset($_POST['project_token']) AND !empty($_POST['project_token'])){
            $project_token = htmlentities(addslashes($_POST['project_token']));
        }else{
            $project_token = $router -> getRouteParam('2');
        }

        if($auth -> emailExist($user_mail) == true){
            $errors = $project -> inviteMember($user_mail, $project_token, "Je t\'invite dans mon projet Khoya");
        }else{
            $errors = ['success' => false, 'options' => ['content' => "L\'utilisateur n\'existe pas !", 'theme' => 'error'] ];
        }

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}



/**
 * Formulaire pour Créer un projet
 * 
 * @fichier d'execution = view/app/project/new/index.php
 * @variable d'execution = $_POST['create_project']                     : type = button
 * 
 * @variable obligatoire = $_POST['name']                               : type = text
 * @variable obligatoire = $_POST['desc']                               : type = text
 * @variable obligatoire = $_POST['status']                             : type = radio
 * @variable facultatif = $_POST['mails_list']                          : type = array
 * 
 */
if(isset($_POST['create_project'])){
    if(isset($_POST['name']) AND !empty($_POST['name']) AND isset($_POST['desc']) AND !empty($_POST['desc']) AND isset($_POST['status']) AND !empty($_POST['status'])){

        $name = htmlentities(addslashes($_POST['name']));
        $desc = htmlentities(addslashes($_POST['desc']));
        $status = htmlentities(addslashes($_POST['status']));
        $invitations = $_POST['mails_list'];

        $errors = $project -> createProject($name, $desc, $status, $invitations);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }
}



 

// End of file
/******************************************************************************/
