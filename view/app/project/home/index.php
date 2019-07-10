<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;
    $project_token = $router -> getRouteParam('2');
?>

<?php // View Content ?>

<?php require_once ('view/app/components/sidebar.php'); ?>
<div class="container-fluid main_wrapper">
    <?php require ('view/app/project/home/components/home.php'); ?>
</div>
