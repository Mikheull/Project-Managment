<?php


/**
 * Script des actions rapides des evenements
 * relié a des boutons en ajax, il fera certaines actions rapides
 * depuis le panel des taches
 * 
 * utilisé dans :
 *  (Direct) - dist/js/calendar/event.js
 *  (Direct) - dist/js/calendar/event.min.js
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
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/utils.php');
require_once ('../../../../model/class/calendar.php');
require_once ('../../../../model/class/task.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$auth = new authentication($db);
$utils = new utils($db);
$calendar = new calendar($db);
$task = new task($db);


if(isset($_POST['result'])){ $result = $_POST['result']; }
$event_token = $_POST['event_token'];
$action = $_POST['action'];
$exp[1] = $event_token;





/**
 * Test de l'envoi en ajax
 */

if($action == 'delete'){
    $errors = $calendar -> disableEvent($event_token);
    echo '<script> document.location.reload(true); </script>';
}


if($action == 'edit'){
    if(!empty($_POST['event_name'])){
        $event_name = cleanVar($_POST['event_name']);
        
        if(isset($_POST['event_desc']) AND !empty($_POST['event_desc'])){ 
            $event_desc = cleanVar($_POST['event_desc']); 
        }else{
            $event_desc = 'undefined';
        }

        $errors = $calendar -> editEvent($event_name, $event_desc, $event_token);
        echo '<script> document.location.reload(true); </script>';

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Remplissez tout les champs !", 'theme' => 'error'] ];
        require_once ('../../../../view/app/project/tools/calendar/home/components/details_custom.php');
    }
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
