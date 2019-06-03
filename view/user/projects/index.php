<?php
    require ('controller/project.php') ;

    if($router -> getRouteParam('0') == 'account'){
        
        if($auth -> isConnected() == true){
            $userToken = $main -> getToken();

            $getUserInvitations = $project -> getUserProjectInvitations( $userToken );
            $getUserProjects = $project -> getUserProject( $userToken );
            $getUserProjectsArchived = $project -> getUserProjectArchived( $userToken );
            $mode = 'user';
        }else{
            header('location: login?return_url=account%2Fprojects');
        }


    }else if($router -> getRouteParam('0') == 'member'){

        require_once ('controller/friend.php');

        $userToken = $user -> usernameToToken($router -> getRouteParam('1'));
        if(empty($userToken)){
            header('location: ../member');
        }
        $getUserProjects = $project -> getUserProject( $userToken );
        $mode = 'member';

    }

?>



<?php // View Content ?>

<?php require_once ('view/components/navbar-header-light.php') ;?>

<div class="container account light-border margin-top-lg margin-bot-lg">
    <div class="account_wrapper">
        <?php 
            require_once ('view/user/components/heading_'. $mode .'.php');
            require_once ('view/user/projects/components/'. $mode .'_bar-head.php');

            if($getUserProjects['count'] !== 0 OR $getUserInvitations['count'] !== 0 OR $getUserProjectsArchived['count'] !== 0){
                require_once ('view/user/projects/components/home_content.php');
            }else{
                require_once ('view/user/projects/components/empty.php'); 
            }
        ?>
    </div>
</div>

<?php require_once ('view/components/footer.php') ;?>



<script> 
    $(document).on('click', '.invite', function() {
	    event.preventDefault();
        $('.invite').modaal();
    });
</script>