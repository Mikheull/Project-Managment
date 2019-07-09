<?php
    require_once ('controller/project.php') ;
    $project_token = $router -> getRouteParam('2');
?>


<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="main_wrapper">
    <?php require ('view/app/project/settings/components/home.php'); ?>
</div>