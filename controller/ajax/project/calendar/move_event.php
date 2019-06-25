<?php


/**
 * Script des déplacement d'events du calendrier
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
require_once ('../../../../model/class/calendar.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$auth = new authentication($db);
$utils = new utils($db);
$calendar = new calendar($db);






/**
 * Test de l'envoi en ajax
 */




$ref = $_POST['ref'];
$exp = explode( '|', $ref);
$date = $_POST['date'];

$errors = $calendar -> moveEvent($date, $exp[1]);


// End of file
/******************************************************************************/
