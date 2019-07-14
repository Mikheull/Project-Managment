<?php
// Taches :
$taskTabs = $task -> getTabs( $router -> getRouteParam('2') );
$allTasks = $task -> getAllTasks( $router -> getRouteParam('2') );



?>


<?php require_once ('view/app/project/components/project_sidebar.php') ?>
<div class="content_wrapper container-fluid">

    <div class="row">
        <div class="col-lg-4 col-md-6 col-12 light-border p-3">
            <div class="heading"> <span class="color-dark text-sm">Tâches</span> </div>
            <div class="body">
                <div><?= $taskTabs['count'] ?> Tableau</div>
                <div><?= $allTasks['count'] ?> Tâches</div>
            </div>
        </div>
    </div>

</div>

