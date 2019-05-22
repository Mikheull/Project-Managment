<?php
    require_once ('controller/team.php') ;
    $allUserTeams = $team -> getUserTeam($main -> getToken());

    if($auth -> isConnected() == true){

        require_once ('view/content/app/components/sidebar.php');
?>


        <div class="container-fluid main_wrapper team_hub">
            <?php
                if($allUserTeams['count'] !== 0){
                    require_once ('view/content/app/team/select/components/home.php');
                }else{
                    require_once ('view/content/app/team/select/components/empty.php');
                }
            ?>
        </div>


<?php
    }else{
        header('location: login?return_url=app%2Fteam');
    }
?>