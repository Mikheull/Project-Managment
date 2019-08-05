<?php


/**
 * Script de cookie accept
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
session_start();

setcookie("accept_cookie", 'accepted', time() + 86400, '/');

// End of file
/******************************************************************************/
