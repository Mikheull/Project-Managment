<?php
require ('../db.php');
session_start();

function load($class){
    require('../model/class/'. $class .'.php');
}
spl_autoload_register("load");


require_once ('../controller/config.php');
require_once ('../controller/admin/router.php');
require_once ('../controller/admin/authentication.php');

/**
 * INIT
 */

@ini_set('display_errors', 'on');
@error_reporting(E_ALL | E_STRICT);