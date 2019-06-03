<?php


/**
 * Script des actions rapides des teams
 * relié a des boutons en ajax, il fera certaines actions rapides
 * depuis le panel des équipes
 * 
 * utilisé dans :
 *  (Direct) - dist/js/short-actions.js
 *  (Direct) - dist/js/short-actions.min.js
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
session_start();

require_once ('../../db.php');

require_once ('../../model/class/main.php');
require_once ('../../model/class/db_connect.php');

require_once ('../../model/class/router.php');
require_once ('../../model/class/config.php');
require_once ('../../model/class/user.php');
require_once ('../../model/class/team.php');
require_once ('../../model/class/authentication.php');

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$team = new team($db);
$auth = new authentication($db);

if(isset($_POST['result'])){ $result = $_POST['result']; }
$team_token = $_POST['team_token'];
$action = $_POST['action'];





/**
 * Test de l'envoi en ajax
 */
if($action == 'invite'){

    if($team -> getTeamData($team_token, 'founder_token') == $main -> getToken()){
        $user_mail = htmlentities(addslashes($result));
        
        if($auth -> emailExist($user_mail) == true){
            $errors = $team -> inviteMember($user_mail, $team_token, "Je t\'invite dans ma team Khoya");
        }else{
            $errors = ['success' => false, 'message' => ['text' => "L\'utilisateur n\'existe pas !", 'theme' => 'dark', 'timeout' => 2000] ];
        }

        // if(isset($errors)){ echo "<script> $( document ).ready(function() { popMessage('".$errors['message']['text']."', '".$errors['message']['theme']."', ".$errors['message']['timeout'].") }) </script>"; }

        print_r($errors);
    }else{
        echo "<script> $( document ).ready(function() { popMessage('Vous n\'avez pas les droits', 'dark', 1000)" ;
    }
    
}



if($action == 'delete'){

    if($team -> getTeamData($team_token, 'founder_token') == $main -> getToken()){
        $errors = $team -> disable($team_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { popMessage('Vous n\'avez pas les droits', 'dark', 1000)" ;
    }
    
}



if($action == 'archive'){

    if($team -> getTeamData($team_token, 'founder_token') == $main -> getToken()){
        $errors = $team -> archive($team_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { popMessage('Vous n\'avez pas les droits', 'dark', 1000)" ;
    }
    
}



if($action == 'unarchive'){

    if($team -> getTeamData($team_token, 'founder_token') == $main -> getToken()){
        $errors = $team -> unarchive($team_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { popMessage('Vous n\'avez pas les droits', 'dark', 1000)" ;
    }
    
}



if($action == 'leave'){

    if($team -> getTeamData($team_token, 'founder_token') !== $main -> getToken()){
        echo 'leave';

        $errors = $team -> kickMember($team_token, $main -> getToken());
        print_r($errors);
    }else{
        echo "<script> $( document ).ready(function() { popMessage('Vous êtes le créateur', 'dark', 1000)" ;
    }
    
}



if($action == 'rename'){

    if($team -> getTeamData($team_token, 'founder_token') == $main -> getToken()){
        $new_name = htmlentities(addslashes($result));
        $errors = $team -> teamRename($team_token, $new_name);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { popMessage('Vous n\'avez pas les droits', 'dark', 1000)" ;
    }
    
}



// End of file
/******************************************************************************/
