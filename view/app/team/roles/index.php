<?php
    require_once ('controller/team.php') ;
    $team_token = $router -> getRouteParam('2');
?>


<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="container-fluid main_wrapper">
    <?php

        if($team -> teamExist($team_token)){

            if($team -> canAcess($team_token, $main -> getToken())){
                require ('view/app/team/roles/components/home.php');
            }else{
                require ('view/app/team/errors/not-found.php');
            }

        }else{
            require ('view/app/team/errors/not-found.php');
        }

    ?>
</div>