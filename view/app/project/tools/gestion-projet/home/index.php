<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;

    $tabs = $task -> getTabs( $router -> getRouteParam('2') );
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="link dark-link active"> Tableaux </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/reports" class="link dark-link"> Rapports </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet/gantt" class="link dark-link"> Gantt </a> </li>
                    </ul>
                </div>
            </div>
        </div>


        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'task.view')){
            ?>
                <div class="row tabs" id="tab_output">
                    <?php require_once ('view/app/project/tools/gestion-projet/home/components/tab_content.php') ;?>
                </div>
            <?php
        }else{
            ?>
            <div class="no-access">Vous n'avez pas la permission nécessaire pour accéder a ce contenu</div>
            <?php
        }
        ?>
        
    </div>
</div>