<?php


/**
 * Script d'ajout de taches en ajax
 * 
 * utilisé dans :
 *  (Direct) - view/app/project/tools/gestion-projet/home/index.php
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

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$task = new task($db);
$auth = new authentication($db);





/**
 * Test de l'envoi en ajax
 */

if(!empty($_POST['task_name']) AND !empty($_POST['deadline']) AND !empty($_POST['duration']) AND !empty($_POST['project_token']) AND !empty($_POST['tab_token'])){
    $task_name = cleanVar($_POST['task_name']);
    $deadline = cleanVar($_POST['deadline']);
    $duration = cleanVar($_POST['duration']);
    $project_token = $_POST['project_token'];
    $tab_token = $_POST['tab_token'];

    $errors = $task -> newTask($project_token, $tab_token, $task_name, $deadline, $duration);

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