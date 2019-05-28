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

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$team = new team($db);

$project = $_POST['project'];
$action = $_POST['action'];


/**
 * Test de l'envoi en ajax
 */
if($action == 'delete_frm'){
    if($team -> getTeamData($project, 'founder_token') == $main -> getToken()){
        echo 'delete';

        $errors = $team -> disable($project);
        print_r($errors);
    }else{
        echo 'pas accès';
    }
}
else if($action == 'leave_frm'){

}
else{

}



// End of file
/******************************************************************************/
