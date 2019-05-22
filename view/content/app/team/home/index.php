<?php
    require_once ('controller/team.php') ;

    if($auth -> isConnected() == true){
        $team_token = $router -> getRouteParam('2');

        require_once ('view/content/app/components/sidebar.php');
?>


        <div class="container-fluid main_wrapper">
            <?php

                if($team -> teamExist($team_token)){

                    if($team -> canAcess($team_token, $main -> getToken())){
                        require ('view/content/app/team/home/components/home.php');
                    }else{
                        require ('view/content/app/team/home/components/error.php');
                    }

                }else{
                    require ('view/content/app/team/home/components/error.php');
                }

            ?>
        </div>


<?php
    }else{
        header('location: ../../login?return_url=app%2Fteam');
    }
?>