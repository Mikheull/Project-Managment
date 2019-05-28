<?php
    require ('controller/team.php') ;

    if($router -> getRouteParam('0') == 'account'){
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();

            $getUserInvitations = $team -> getUserTeamInvitations( $userToken );
            $getUserTeams = $team -> getUserTeam( $userToken );
            $mode = 'user';
        }else{
            header('location: login?return_url=account%2Fteams');
        }


    }else if($router -> getRouteParam('0') == 'member'){

        require_once ('controller/friend.php');

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            header('location: ../member');
        }
        $getUserTeams = $team -> getUserTeam( $userToken );
        $mode = 'member';

    }

?>



<?php // View Content ?>

<div id="account-bg"> <?php require_once ('view/components/navbar-header-dark.php') ;?> </div>

<div class="container account floating_container">
    <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
    <div class="team">
        <div class="row bar">
            <div class="col">
               <?php require_once ('view/user/teams/components/'. $mode .'_bar-head.php') ?>
            </div>
        </div>

        <div class="row content">
            <?php
                if($getUserTeams['count'] !== 0){
                    require ('view/user/teams/components/home_content.php');
                }else{
                    require ('view/user/teams/components/empty.php');
                }
            ?>
        </div>
    </div>
</div>
<?php require_once ('view/components/footer.php') ;?>



<script> 
    $(document).on('click', '.invite', function() {
	    event.preventDefault();
        $('.invite').modaal();
    });
</script>