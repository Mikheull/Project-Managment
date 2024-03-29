<?php


/**
 * Script des relations entre utilisateurs
 * Il gère les méthodes relative a la class friend
 * 
 * utilisé dans :
 *  (Direct) - view/account/followers/index.php
 *  (Direct) - view/account/following/index.php
 *  (Direct) - view/member/followers/index.php
 *  (Direct) - view/member/followers/index.php
 *  (Direct) - view/member/home/index.php
 *  (Direct) - view/member/projects/index.php
 *  (Direct) - view/member/teams/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
$friend = new friend($db);



/**
 * Formulaire pour suivre un utilisateur
 * 
 * @fichier d'execution = view/member/(*)/index.php
 * @variable d'execution = $_POST['follow']                         : type = button
 * 
 */
if(isset($_POST['follow'])){
    $errors = $friend -> follow( $main -> getToken(), $user -> usernameToToken($router -> getRouteParam('1')) );
}



/**
 * Formulaire pour arreter de suivre un utilisateur
 * 
 * @fichier d'execution = view/member/(*)/index.php
 * @variable d'execution = $_POST['unfollow']                       : type = button
 * 
 */
if(isset($_POST['unfollow'])){
    $errors = $friend -> unfollow( $main -> getToken(), $user -> usernameToToken($router -> getRouteParam('1')) );
}

// End of file
/******************************************************************************/
