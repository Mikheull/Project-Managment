<?php


/**
 * Script des actions rapides des projets
 * relié a des boutons en ajax, il fera certaines actions rapides
 * depuis le panel des projets
 * 
 * utilisé dans :
 *  (Direct) - dist/js/short-actions.js
 *  (Direct) - dist/js/short-actions.min.js
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
require_once ('../../model/class/user.php');
require_once ('../../model/class/project.php');
require_once ('../../model/class/authentication.php');

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$auth = new authentication($db);

if(isset($_POST['result'])){ $result = $_POST['result']; }
$project_token = $_POST['project_token'];
$action = $_POST['action'];





/**
 * Test de l'envoi en ajax
 */
if($action == 'invite'){

    if($project -> getProjectData($project_token, 'founder_token') == $main -> getToken()){
        $user_mail = cleanVar($result);
        
        if($auth -> emailExist($user_mail) == true){
            $errors = $project -> inviteMember($user_mail, $project_token, "Je t\'invite dans mon projet Khoya");
        }else{
            $errors = ['success' => false, 'options' => ['content' => "L\'utilisateur n\'existe pas !", 'theme' => 'error'] ];
        }

        print_r($errors);
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}


if($action == 'delete'){

    if($project -> getProjectData($project_token, 'founder_token') == $main -> getToken()){
        $errors = $project -> disable($project_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'archive'){

    if($project -> getProjectData($project_token, 'founder_token') == $main -> getToken()){
        $errors = $project -> archive($project_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'unarchive'){

    if($project -> getProjectData($project_token, 'founder_token') == $main -> getToken()){
        $errors = $project -> unarchive($project_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'leave'){

    if($project -> getProjectData($project_token, 'founder_token') !== $main -> getToken()){
        echo 'leave';

        $errors = $project -> kickMember($project_token, $main -> getToken());
        print_r($errors);
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous êtes le créateur', theme: 'error'});" ;
    }
    
}



if($action == 'rename'){

    if($project -> getProjectData($project_token, 'founder_token') == $main -> getToken()){
        $new_name = cleanVar($result);
        $errors = $project -> projectRename($project_token, $new_name);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
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
