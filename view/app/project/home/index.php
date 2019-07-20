<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;
    require_once ('controller/dashboard.php') ;
    $project_token = $router -> getRouteParam('2');
?>

<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require ('view/app/project/home/components/home.php'); ?>
</div>
