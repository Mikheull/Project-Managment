<?php
    require_once ('controller/team.php') ;

    if($team -> canAcess($router -> getRouteParam('3'), $main -> getToken()) == false){

        $errors = $team -> joinTeam($router -> getRouteParam('3'), $main -> getToken());

        if($errors['success'] == true){
            ?> <script>location.href="<?= $config -> rootUrl().'app/team/'. $router -> getRouteParam('3') ?>"</script> <?php
        }else{
            ?> <script>location.href="<?= $config -> rootUrl().'app/join/team/'. $router -> getRouteParam('3') ?>"</script> <?php
        }
    }else{
        ?> <script>location.href="<?= $config -> rootUrl().'app/team/'. $router -> getRouteParam('3') ?>"</script> <?php
    }
