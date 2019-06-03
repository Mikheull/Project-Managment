<?php

    $_POST['remove_member'] = true;
    $_POST['team_token'] = $router -> getRouteParam('2');
    $_POST['user_token'] = $router -> getRouteParam('5');

    require_once ('controller/team.php') ;
?>
