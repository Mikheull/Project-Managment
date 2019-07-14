<?php


/**
 * Script de recherche
 * 
 * utilisé dans :
 * 
 */

/******************************************************************************/


/**
 * Declaration des variables
 */
session_start();

require_once ('../../../db.php');

require_once ('../../../model/class/main.php');
require_once ('../../../model/class/db_connect.php');

require_once ('../../../model/class/router.php');
require_once ('../../../model/class/config.php');
require_once ('../../../model/class/user.php');
require_once ('../../../model/class/project.php');
require_once ('../../../model/class/projectTeam.php');
require_once ('../../../model/class/bug.php');
require_once ('../../../model/class/authentication.php');
require_once ('../../../model/class/permission.php');

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$projectTeam = new projectTeam($db);
$bug = new bug($db);
$auth = new authentication($db);
$permission = new permission($db);





/**
 * Test de l'envoi en ajax
 */




$type = $_POST['type'];
$query = $_POST['query'];
$keyword = $_POST['keyword'];
$param = $_POST['param'];

$request_query = $projectTeam -> search($type, $query, $keyword, $param);
if(empty($request_query)){
    ?> 
        <div class="no-data">
            <div class="icon"> <i class="fas fa-exclamation"></i> </div>
            <div class="text">Aucun résultat trouvé pour la recherche</div>
            <div class="table_return"> <span>Refresh</span> </div>
        </div>
        <?php
}else{
    ?><table><?php
    foreach($request_query as $tm){
        require ('../../../view/app/project/tools/gestion-equipe/team/components/vue_item.php');
    }
    ?></table><?php

}

?>

<script>
$( ".table_return" ).click(function() {
    $(".table_search input").val('');
    $("#searchOutput").load(location.href + " #searchOutput");
})
</script>