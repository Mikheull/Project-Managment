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


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$task = new task($db);
$auth = new authentication($db);
$utils = new utils($db);

if(isset($_POST['result'])){ $result = $_POST['result']; }
$tab_token = $_POST['tab_token'];
$action = $_POST['action'];
if(isset($_POST['project_token'])){ $project_token = $_POST['project_token']; }





/**
 * Test de l'envoi en ajax
 */

if($action == 'delete'){
    $errors = $task -> disableTab($tab_token);
    echo '<script> document.location.reload(true); </script>';
    
}


if($action == 'rename'){

    $new_name = cleanVar($result);
    $errors = $task -> tabRename($tab_token, $new_name);
    
}


if($action == 'export'){
    ?> <script>location.href="../../../../app/project/<?= $project_token ?>/t/gestion-projet/export/<?= $tab_token ?>"</script> <?php
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
