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

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$bug = new bug($db);
$auth = new authentication($db);





/**
 * Test de l'envoi en ajax
 */

if(isset($_POST['bug_name']) AND !empty($_POST['bug_name']) AND isset($_POST['bug_desc']) AND !empty($_POST['bug_desc'])){
    $bug_name = cleanVar($_POST['bug_name']);
    $bug_desc = cleanVar($_POST['bug_desc']);
    $project_token = $_POST['project_token'];

    if(strlen($bug_desc) <= 254){
        $errors = $bug -> newBug($project_token, $bug_name, $bug_desc);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "La description est trop longue !", 'theme' => 'error'] ];
    }

}else{
    $errors = ['success' => false, 'options' => ['content' => "Remplissez tout les champs !", 'theme' => 'error'] ];
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