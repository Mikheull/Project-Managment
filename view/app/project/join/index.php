<?php
    require_once ('controller/project.php') ;

    if($project -> canAcess($router -> getRouteParam('3'), $main -> getToken()) == false){

        $errors = $project -> joinProject($router -> getRouteParam('3'), $main -> getToken());

        if($errors['success'] == true){
            ?> <script>location.href="<?= $config -> rootUrl().'app/project/'. $router -> getRouteParam('3') ?>"</script> <?php
        }else{
            ?> <script>location.href="<?= $config -> rootUrl().'app/join/project/'. $router -> getRouteParam('3') ?>"</script> <?php
        }
    }else{
        ?> <script>location.href="<?= $config -> rootUrl().'app/project/'. $router -> getRouteParam('3') ?>"</script> <?php
    }
