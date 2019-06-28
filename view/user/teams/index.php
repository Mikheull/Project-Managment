<?php
    require ('controller/team.php') ;

    if($router -> getRouteParam('0') == 'account'){
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();

            $getUserInvitations = $team -> getUserTeamInvitations( $userToken );
            $getUserTeams = $team -> getUserTeam( $userToken );
            $getUserTeamsArchived = $team -> getUserTeamArchived( $userToken );
            $mode = 'user';
        }else{
            header('location: '. $config -> rootUrl() .'login?return_url=account%2Fteams');
        }


    }else if($router -> getRouteParam('0') == 'member'){

        require_once ('controller/friend.php');

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            header('location: '. $config -> rootUrl() .'member');
        }
        $getUserTeams = $team -> getUserTeam( $userToken );
        $mode = 'member';

    }

?>



<?php // View Content ?>

<?php require_once ('view/components/navbar-header-light.php') ;?>

<div class="container account margin-top-lg margin-bot-lg">

    <div class="row">
        <div class="col-md-3 col-12">
            <?php require_once ('view/user/components/heading_'. $mode .'.php') ;?>
        </div>
        
        <div class="col-md-9 col-12">
            <?php require_once ('view/user/components/navbar_'. $mode .'.php') ;?>
            <?php require_once ('view/user/teams/components/'. $mode .'_bar-head.php');

                if($getUserTeams['count'] !== 0 OR $getUserInvitations['count'] !== 0 OR $getUserTeamsArchived['count'] !== 0){
                    require_once ('view/user/teams/components/home_content.php');
                }else{
                    require_once ('view/user/teams/components/empty.php'); 
                }
            ?>
        </div>
    </div>

</div>

<?php require_once ('view/components/footer.php') ;?>
