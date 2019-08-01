<?php


/**
 * Script de gestion de messenger
 * 
 * utilisé dans :
 *  (Direct) - view/app/project/tools/messenger/home/index.php
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
require_once ('../../../../model/class/messenger.php');
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/permission.php');
require_once ('../../../../model/class/utils.php');
require_once ('../../../../model/class/activity.php');

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$messenger = new messenger($db);
$auth = new authentication($db);
$permission = new permission($db);
$utils = new utils($db);
$activity = new activity($db);






/**
 * Test de l'envoi en ajax
 */
if(isset($_POST['action']) AND $_POST['action'] == 'new_channel'){

    if(isset($_POST['channel_name']) AND !empty($_POST['channel_name']) AND isset($_POST['channel_topic']) AND !empty($_POST['channel_topic']) AND isset($_POST['project_token']) AND !empty($_POST['project_token'])){
        $channel_name = cleanVar($_POST['channel_name']);
        $channel_topic = (isset($_POST['channel_topic']) ? cleanVar($_POST['channel_topic']) : 'Aucun topic défini');
        $project_token = cleanVar($_POST['project_token']);
        
        if($permission -> hasPermission($main -> getToken(), $project_token, 'messenger.channel.create')){
            $errors = $messenger -> newChannel($project_token, $channel_name, $channel_topic);
        }else{
            $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
        }

    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous devez remplir tout les champs obligatoires !", 'theme' => 'error'] ];
    }

}



if(isset($_POST['action']) AND $_POST['action'] == 'delete_message'){
    $message_token = cleanVar($_POST['message_token']);

    $errors = $messenger -> deleteMessage($message_token);
    echo '<script> document.location.reload(true); </script>';
}


if(isset($_POST['action']) AND $_POST['action'] == 'edit_message-part1'){
    $message_token = cleanVar($_POST['message_token']);

    echo $utils -> getData('pr_messenger_message', 'content', 'message_token', $message_token);
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