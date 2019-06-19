<?php


/**
 * Script des actions rapides des teams
 * relié a des boutons en ajax, il fera certaines actions rapides
 * depuis le panel des équipes
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
require_once ('../../model/class/team.php');
require_once ('../../model/class/authentication.php');
require_once ('../../model/class/utils.php');

$main = new main();
$router = new router($db);
$config = new config();
$user = new user($db);
$team = new team($db);
$auth = new authentication($db);
$utils = new utils($db);

if(isset($_POST['result'])){ $result = $_POST['result']; }
if(isset($_POST['member'])){ $member = $_POST['member']; }
if(isset($_POST['team_token'])){ $team_token = $_POST['team_token']; }
if(isset($_POST['action'])){ $action = $_POST['action']; }



if (strpos($_SERVER['HTTP_REFERER'], 'app') !== false) {
    $teamData = $team -> getTeamMembers($team_token);

    foreach($teamData['content'] as $u){
        require ('../../view/app/team/members/components/user_item.php');
    }
}




/**
 * Test de l'envoi en ajax
 */
if($action == 'invite'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $main -> getToken()){
        $user_mail = htmlentities(addslashes($result));
        
        if($auth -> emailExist($user_mail) == true){
            $errors = $team -> inviteMember($user_mail, $team_token, "Je t\'invite dans ma team Khoya");
        }else{
            $errors = ['success' => false, 'options' => ['content' => "L\'utilisateur n\'existe pas !", 'theme' => 'error'] ];
        }

    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'delete'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $main -> getToken()){
        $errors = $team -> disable($team_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'archive'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $main -> getToken()){
        $errors = $team -> archive($team_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'unarchive'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $main -> getToken()){
        $errors = $team -> unarchive($team_token);
        echo '<script> document.location.reload(true); </script>';
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous n\'avez pas les droits', theme: 'error'});" ;
    }
    
}



if($action == 'leave'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) !== $main -> getToken()){
        $errors = $team -> kickMember($team_token, $main -> getToken());
        print_r($errors);
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous êtes le créateur', theme: 'error'});" ;
    }
    
}



if($action == 'kick'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) !== $member){
        $errors = $team -> kickMember($team_token, $member);
        $utils -> addlog($main -> getToken(),  $team_token, 'pr_team_member', 'team-kick', ['user_kicked' => $member]);
    }else{
        echo "<script> $( document ).ready(function() { notify.new({content : 'Vous ne pouvez pas vous retirer', theme: 'error'});" ;
    }
    
}



if($action == 'rename'){

    if($utils -> getData('pr_team', 'founder_token', 'public_token', $team_token) == $main -> getToken()){
        $new_name = htmlentities(addslashes($result));
        $errors = $team -> teamRename($team_token, $new_name);
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
