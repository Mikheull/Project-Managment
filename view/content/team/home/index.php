<?php 
    require ('controller/team.php') ;
    
    $allUserinvitations = $team -> getUserTeamInvitations($_SESSION['user_token']);
    $allUserTeams = $team -> getUserTeam($_SESSION['user_token']);
;?>

<?php
    if($auth -> isConnected() == true){
?>


    <?php require ('view/components/navbar-header-light.php') ;?>


    <div class="container team_hub">
        <?php
            if($allUserTeams['count'] !== 0){
                require ('view/content/team/home/components/home.php');
            }else{
                require ('view/content/team/home/components/empty.php');
            }
        ?>
    </div>

    <?php require ('view/content/team/home/components/modals.php'); ?>
       
    <?php require ('view/components/footer.php') ;?>


<?php
    }else{
        header('location: login?return_url=team');
    }
?>