<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;

    $activity = $task -> getActivity( $router -> getRouteParam('2') );
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/gestion-projet/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="link dark-link"> Tableaux </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/reports" class="link dark-link"> Rapports </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/gantt" class="link dark-link active"> Gantt </a> </li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="row">
            <?php 
            if($activity['count'] !== 0){
                ?>
                Gantt
                <?php
            }else{
                ?>
                 <div class="col-8 offset-2 text-align-center margin-top-lg">
                    <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_task_activities.svg" alt="" width="50%">
                    <h3 class="title-sm bold color-dark margin-bot-lg margin-top-lg">Aucunes données pour le moment !</h3>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>