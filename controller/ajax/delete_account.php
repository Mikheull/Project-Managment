<?php


/**
 * Script de "suppression" de compte
 * 
 * utilisé dans :
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

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);


$token = $main -> getToken();
$user -> deleteUser($token);

setcookie("user_email", '', time() - 86400);
setcookie("user_password", '', time() - 86400);
session_destroy();


// End of file
/******************************************************************************/