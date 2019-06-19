<?php


/**
 * Script des ajouts d'events calendrier
 * 
 * utilisé dans :
 *  (Direct) - view/app/project/tools/calendar/home/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
session_start();

require_once ('../../../../db.php');

require_once ('../../../../model/class/main.php');
require_once ('../../../../model/class/db_connect.php');

require_once ('../../../../model/class/router.php');
require_once ('../../../../model/class/config.php');
require_once ('../../../../model/class/user.php');
require_once ('../../../../model/class/project.php');
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/utils.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$auth = new authentication($db);
$utils = new utils($db);

$project_token = $_POST['project_token'];
$name = $_POST['name'];
$start = $_POST['start'];
$end = $_POST['end'];




/**
 * Test de l'envoi en ajax
 */

echo "ajout de ". $name ." - ". $project_token ." - ". $start ." - ". $end;

// End of file
/******************************************************************************/
