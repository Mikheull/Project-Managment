<?php


/**
 * Script des diagrammes d'affinité
 * relié a des boutons en ajax, il fera certaines actions
 * 
 * utilisé dans :
 *  (Direct) - dist/js/recherche-utilisateur/affinity-diagram.js
 *  (Direct) - dist/js/recherche-utilisateur/affinity-diagram.min.js
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
require_once ('../../../../model/class/recherche_utilisateur.php');
require_once ('../../../../model/class/authentication.php');
require_once ('../../../../model/class/utils.php');
require_once ('../../../../model/class/permission.php');
require_once ('../../../../model/class/activity.php');


$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$project = new project($db);
$recherche_utilisateur = new recherche_utilisateur($db);
$auth = new authentication($db);
$utils = new utils($db);
$permission = new permission($db);
$activity = new activity($db);

$diagram_token = $_POST['diagram_token'];
$project_token = $_POST['project_token'];
$action = $_POST['action'];
if(isset($_POST['result'])){ $result = $_POST['result']; }





/**
 * Test de l'envoi en ajax
 */

if($action == 'ended'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'user-research.affinity.edit')){
        $errors = $recherche_utilisateur -> closeAffinityDiagram($diagram_token, $project_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }
}
if($action == 'reopen'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'user-research.affinity.edit')){
        $errors = $recherche_utilisateur -> reopenAffinityDiagram($diagram_token, $project_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }
}

if($action == 'delete'){
    if($permission -> hasPermission($main -> getToken(), $project_token, 'user-research.affinity.delete')){
        $errors = $recherche_utilisateur -> disableAffinityDiagram($diagram_token, $project_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }
}

if($action == 'new_idea'){
    $userSessionToken = session_id();
    $errors = $recherche_utilisateur -> sendIdea($project_token, $diagram_token, $userSessionToken, $result);

    
    // Refresh ajax
    require ('../../../../view/app/ur/affinity-diagram/components/idea_item.php');
}

if($action == 'approve_idea'){
    if(isset($_POST['idea'])){ $idea_token = $_POST['idea']; }

    if($permission -> hasPermission($main -> getToken(), $project_token, 'user-research.affinity.approve')){
        $errors = $recherche_utilisateur -> approveIdea($diagram_token, $idea_token, $project_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
    }
}

if($action == 'remove_idea'){
    if(isset($_POST['idea'])){ $idea_token = $_POST['idea']; }

    if($permission -> hasPermission($main -> getToken(), $project_token, 'user-research.affinity.approve')){
        $errors = $recherche_utilisateur -> removeIdea($diagram_token, $idea_token, $project_token);
    }else{
        $errors = ['success' => false, 'options' => ['content' => "Vous n\'avez pas la permission !", 'theme' => 'error'] ];
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
