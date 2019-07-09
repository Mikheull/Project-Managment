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
require_once ('../../model/class/utils.php');

$main = new main();
$router = new router($db);
$config = new config();
$search = new search($db);
$user = new user($db);
$team = new team($db);
$project = new project($db);
$utils = new utils($db);

$keyword = cleanVar($_POST['keyword']);
$type = cleanVar($_POST['type']);




?>
<script>
    setTimeout(function() {
        $('#loading_data').fadeOut( 300 );
        setTimeout(function() {
            $('#output_data').show();
        }, 300);
    }, 600);
</script>
<?php

/**
 * Recherche de similarité du keyword dans la base de données
 */
if($type == 'member'){
    $search -> searchContent($keyword, 'member');
}else if($type == 'team'){
    isset($_SESSION['user_token']) ? $search -> searchContent($keyword, 'team', $main -> getToken() ) : $search -> searchContent($keyword, 'team');
}else if($type == 'project'){
    isset($_SESSION['user_token']) ? $search -> searchContent($keyword, 'project', $main -> getToken() ) : $search -> searchContent($keyword, 'project');
}


$queryReturn = $search -> getQueryResult();
if( empty($queryReturn) ){
    ?> <div class="result_empty"> Aucun résultats ! </div> <?php
}else{
    foreach($queryReturn as $item){
        if($type == 'member'){
            require ('../../view/landing/search/components/user-card.php');
        }else if($type == 'team'){
            $t['team_token'] = $item;
            require ('../../view/user/teams/components/card.php');
        }else if($type == 'project'){
            $t['project_token'] = $item;
            require ('../../view/user/projects/components/card.php');
        }
    }
}





// End of file
/******************************************************************************/
