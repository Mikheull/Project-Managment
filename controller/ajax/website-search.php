<?php


/**
 * Script de recherche d'utilisateur
 * relié a un formulaire en ajax, il retournera les utilisateurs 
 * simmilaire a un keyword passé en paramètre POST
 * 
 * utilisé dans :
 *  (Direct) - dist/js.website-search.js
 *  (Indirect) - view/landing/search/index.php
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
require_once ('../../model/class/search.php');
require_once ('../../model/class/user.php');
require_once ('../../model/class/team.php');
require_once ('../../model/class/project.php');

$main = new main();
$router = new router($db);
$config = new config();
$search = new search($db);
$user = new user($db);
$team = new team($db);
$project = new project($db);

$keyword = htmlentities($_POST['keyword']);
$type = htmlentities($_POST['type']);



/**
 * Recherche de similarité du keyword dans la base de données
 */
if($type == 'member'){
    $queryReturn = $search -> searchUser($keyword);
}else if($type == 'team'){
    isset($_SESSION['user_token']) ? $search -> searchTeam($keyword, $main -> getToken() ) : $search -> searchTeam($keyword);
}else if($type == 'project'){
    isset($_SESSION['user_token']) ? $search -> searchProject($keyword, $main -> getToken() ) : $search -> searchProject($keyword);
}


$queryReturn = $search -> getQueryResult();
if( empty($queryReturn) ){
    ?> <div class="result_empty"> Aucun résultats ! </div> <?php
}else{
    foreach($queryReturn as $item){
        require ('../../view/landing/search/components/search-item.php');
    }
}


// End of file
/******************************************************************************/
