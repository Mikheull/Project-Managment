<?php
    $teamData = $team -> getTeamMembers($team_token);
?>




<?php // View Content ?>

<?php require_once ('view/app/team/components/team_sidebar.php') ?>

<div class="content_wrapper">
    

    <div class="container table_content margin-top-lg">
        <div class="row member_heading margin-bot-lg">
            <div class="col-md-3 col-6 bold">Utilisateur</div>
            <div class="col-md-5 col-6 bold">Rôles</div>
            <div class="col-md-3 col-10 bold">Date d’arrivée</div>
            <div class="col-md-1 col-2 bold"></div>
        </div>

        <div id="team_output">
            <?php
                foreach($teamData['content'] as $u){
                    require ('view/app/team/members/components/user_item.php');
                }
            ?>
        </div>
    </div>

</div>

