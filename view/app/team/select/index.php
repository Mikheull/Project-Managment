<?php
    require_once ('controller/team.php') ;
    $allUserTeams = $team -> getUserTeam($main -> getToken());
?>



<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="fakeLoader"></div>
<div class="container-fluid main_wrapper team_hub text-align-center">
    <?php
        if($allUserTeams['count'] !== 0){
            require_once ('view/app/team/select/components/home.php');
        }else{
            require_once ('view/app/team/select/components/empty.php');
        }
    ?>
</div>