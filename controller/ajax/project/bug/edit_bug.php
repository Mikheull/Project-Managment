<?php


/**
 * Script d'ajout de bug en ajax
 * 
 * utilisé dans :
 *  (Direct) - view/app/project/tools/bug-tracker/home/index.php
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
require_once ('../../../../model/class/bug.php');
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/permission.php');

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$bug = new bug($db);
$auth = new authentication($db);
$permission = new permission($db);





/**
 * Test de l'envoi en ajax
 */

$bug_token = cleanVar($_POST['bug_token']);
$new_status = cleanVar($_POST['new_status']);
if(isset($_POST['project_token'])){ $project_token = $_POST['project_token']; }


if($permission -> hasPermission($main -> getToken(), $project_token, 'bug-tracker.move')){
    if($new_status == 2){
        $errors = $bug -> setWorkinBug($bug_token, $project_token);
    }else if($new_status == 3){
        $errors = $bug -> setEndBug($bug_token, $project_token);
    }else{
        $errors = $bug -> disableBug($bug_token, $project_token);
    }
}else{
    $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
}

// Refresh ajax
require ('../../../../view/app/project/tools/bug-tracker/home/components/tab_content.php');


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