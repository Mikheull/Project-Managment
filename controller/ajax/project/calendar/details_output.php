<?php


/**
 * Script des détails d'events calendrier
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
require_once ('../../../../model/class/task.php');
require_once ('../../../../model/class/activity.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$auth = new authentication($db);
$utils = new utils($db);
$calendar = new calendar($db);
$task = new task($db);
$activity = new activity($db);


$event_ref = $_POST['ref'];
$exp = explode( '|', $event_ref);
$event_token = $exp[1];
$project_token = $_POST['project_token'];


if($exp[0] == 'task'){
    require_once ('../../../../view/app/project/tools/calendar/home/components/overlay-task-info.php');
}else if($exp[0] == 'custom'){
    require_once ('../../../../view/app/project/tools/calendar/home/components/overlay-event-info.php');
}


// End of file
/******************************************************************************/
