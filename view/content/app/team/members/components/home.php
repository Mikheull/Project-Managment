<?php require_once ('view/content/app/team/components/team_sidebar.php') ?>


<div class="content_wrapper">
    
    <?php
        $teamData = $team -> getTeamMembers($team_token);

        echo "Il y'a ".$teamData['count']." membres dans l'équipe <br> <br>";

        foreach($teamData['content'] as $u){
            echo $user -> getUserData($u['user_public_token'], 'username')."<br>";
        }
    ?>



    Inviter un membre
    <form method="post">
        <input type="text" name="user_token" id="user_token" placeholder="Token de l'utilisateur">

        <button class="primary-btn" name="invite_member">Inviter</button>
    </form>


</div>