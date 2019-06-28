<?php
    require_once ('controller/project.php') ;
    $project_token = $router -> getRouteParam('2');
?>

<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="container-fluid main_wrapper">
    <?php

        if($project -> projectExist($project_token)){

            if($project -> canAcess($project_token, $main -> getToken())){
                require ('view/app/project/home/components/home.php');
            }else{
                if($utils -> getData('pr_project', 'public', 'public_token', $project_token) == true){
                    require ('view/app/project/errors/public-join.php');
                }else{
                    require ('view/app/project/errors/private-join.php');
                }
            }

        }else{
            require ('view/app/project/errors/not-found.php');
        }

    ?>
</div>
