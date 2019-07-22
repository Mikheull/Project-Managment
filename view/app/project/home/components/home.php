<?php
// Taches :
$taskTabs = $task -> getTabs( $router -> getRouteParam('2') );
$allMembers = $project -> getProjectUser( $router -> getRouteParam('2') );
$allTasks = $task -> getAllTasks( $router -> getRouteParam('2') );
$allBugs = $bug -> getBugs($router -> getRouteParam('2'));


?>


<?php require_once ('view/app/project/components/project_sidebar.php') ?>

<div class="content_wrapper">
    <div class="container-fluid zone_container">
        <div class="row d-flex justify-content-between mr-bot-lg">
            <?php require_once ('view/app/project/home/components/tasks.php') ?>
        </div>
        <div class="row d-flex justify-content-between mr-bot-lg">
            <?php require_once ('view/app/project/home/components/generals.php') ?>
        </div>
        <div class="row d-flex justify-content-between mr-bot-lg">
            <?php require_once ('view/app/project/home/components/bugs.php') ?>
        </div>
    </div>
</div>