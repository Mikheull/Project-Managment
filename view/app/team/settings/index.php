<?php
    require_once ('controller/team.php') ;
    $team_token = $router -> getRouteParam('2');
?>


<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="main_wrapper">
    <?php require ('view/app/team/settings/components/home.php'); ?>
</div>