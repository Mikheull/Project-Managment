<?php


/**
 * Script des actions rapides des tableau
 * relié a des boutons en ajax, il fera certaines actions rapides
 * depuis le panel des taches
 * 
 * utilisé dans :
 *  (Direct) - dist/js/task/tabs.js
 *  (Direct) - dist/js/task/tabs.min.js
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
require_once ('../../../../model/class/task.php');
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/utils.php');
require_once ('../../../../model/class/permission.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$task = new task($db);
$auth = new authentication($db);
$utils = new utils($db);
$permission = new permission($db);

if(isset($_POST['result'])){ $result = $_POST['result']; }
$tab_token = $_POST['tab_token'];
$action = $_POST['action'];
if(isset($_POST['project_token'])){ $project_token = $_POST['project_token']; }
if(isset($_POST['tab_token'])){ $tab_token = $_POST['tab_token']; }





/**
 * Test de l'envoi en ajax
 */

if($action == 'delete'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'task.tab.delete')){
        $errors = $task -> disableTab($tab_token, $project_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }


    // Refresh ajax
    $tabs = $task -> getTabs( $project_token );
    require ('../../../../view/app/project/tools/gestion-projet/home/components/tab_content.php');
}


if($action == 'rename'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'task.tab.edit')){
        $new_name = cleanVar($result);
        $errors = $task -> tabRename($tab_token, $project_token, $new_name);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }


    // Refresh ajax
    $tabs = $task -> getTabs( $project_token );
    require ('../../../../view/app/project/tools/gestion-projet/home/components/tab_content.php');
}


if($action == 'export'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'task.tab.export')){
        ?> <script>location.href="../../../../app/project/<?= $project_token ?>/t/gestion-projet/export/<?= $tab_token ?>"</script> <?php
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];

        // Refresh ajax
        $tabs = $task -> getTabs( $project_token );
        require ('../../../../view/app/project/tools/gestion-projet/home/components/tab_content.php');
    }
}


if($action == 'assign_tab'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'task.assign')){
        $assigned_teams = isset($_POST['assigned_teams']) ? $_POST['assigned_teams'] : '';
        $errors = $task -> tabAssignTeam($project_token, $tab_token, $assigned_teams);

        $assigned_members = isset($_POST['assigned_members']) ? $_POST['assigned_members'] : '';
        $errors = $task -> tabAssignMember($project_token, $tab_token, $assigned_members);

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }

    
    ?> <script> location.reload(); </script> <?php
}

if(isset($errors)){
    ?>
    <script>
        $( document ).ready(function() {
            notify.new({
                content : '<?= $errors['options']['content'] ;?>',
                <?php if(isset($errors['options']['position'])){ echo 'position : \''.$errors['options']['position'].'\'' ;}?>
                <?php if(isset($errors['options']['animation'])){ echo 'animation : \''.$errors['options']['animation'].'\'' ;}?>
                <?php if(isset($errors['options']['clickToHide'])){ echo 'clickToHide : \''.$errors['options']['clickToHide'].'\'' ;}?>
                <?php if(isset($errors['options']['autoHide'])){ echo 'autoHide : \''.$errors['options']['autoHide'].'\'' ;}?>
                <?php if(isset($errors['options']['autoHideDelay'])){ echo 'autoHideDelay : \''.$errors['options']['autoHideDelay'].'\'' ;}?>
                <?php if(isset($errors['options']['size'])){ echo 'size : \''.$errors['options']['size'].'\'' ;}?>
                <?php if(isset($errors['options']['theme'])){ echo 'theme : \''.$errors['options']['theme'].'\'' ;}?>
                <?php if(isset($errors['options']['showDuration'])){ echo 'showDuration : \''.$errors['options']['showDuration'].'\'' ;}?>
                <?php if(isset($errors['options']['hideDuration'])){ echo 'hideDuration : \''.$errors['options']['hideDuration'].'\'' ;}?>
            });
        });
    </script>
    <?php
}

// End of file
/******************************************************************************/
