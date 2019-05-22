<?php


/**
 * Script de recherche d'utilisateur
 * relié a un formulaire en ajax, il retournera les utilisateurs 
 * simmilaire a un keyword passé en paramètre POST
 * 
 * utilisé dans :
 *  (Direct) - dist/js.research_user.js
 *  (Direct) - dist/js.research_user.min.js
 *  (Indirect) - view/content/member/search/index.php
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
session_start();

require_once ('../../db.php');
require_once ('../../model/class/db_connect.php');

require_once ('../../model/class/router.php');
require_once ('../../model/class/config.php');
require_once ('../../model/class/search.php');

$router = new router($db);
$config = new config();
$search = new search($db);

$keyword = htmlentities($_POST['keyword']);


/**
 * Recherche de similarité du keyword dans la base de données
 */
$queryReturn = $search -> searchUser($keyword);


if( empty( $queryReturn ) ){

    ?> <li class="result_empty"> Aucun utilisateur n'a été trouvé ! </li> <?php

}else{

    foreach($queryReturn as $item){
        require ('../../view/content/member/search/components/search-item.php');
    }

}

// End of file
/******************************************************************************/
