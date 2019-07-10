<?php

require_once ('db.php');

session_start();

function load($class){
    require('model/class/'. $class .'.php');
}
spl_autoload_register("load");

require_once ('controller/config.php');
// require_once ('model/class/main.php');
$main = new main();

require_once ('controller/router.php');
require_once ('controller/user.php');
require_once ('controller/utils.php');
require_once ('controller/authentication.php');
require_once ('controller/project.php') ;
require_once ('controller/team.php') ;




/**
 * INIT
 */

@ini_set('display_errors', 'on');
@error_reporting(E_ALL | E_STRICT);
setlocale(LC_TIME, "fr_FR");

