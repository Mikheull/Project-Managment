<?php
    require_once ('controller/project.php') ;
    require_once ('controller/bug.php') ;
    $activity = $bug -> getActivity( $router -> getRouteParam('2') );

?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="content_wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-12 navbar-app">
                    <div class="navbar-nav">
                        <ul class="text-align-left">
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="link dark-link"> Bugs </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker/reports" class="link dark-link active"> Rapports </a> </li>
                        </ul>
                    </div>
                </div>
            </div>



            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'bug-tracker.view')){
                
                if($activity['count'] !== 0){
                    require_once ('view/app/project/tools/bug-tracker/reports/components/contrib_chart_month.php');
                    
                }else{
                    ?>
                    <div class="col-8 offset-2 text-align-center mr-top-lg">
                        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_task_activities.svg" alt="" width="50%">
                        <h3 class="title-sm bold color-dark mr-bot-lg mr-top-lg">Aucunes données pour le moment !</h3>
                    </div>
                    <?php
                }
            }else{
                ?>
                <div class="no-access">Vous n'avez pas la permission nécessaire pour accéder a ce contenu</div>
                <?php
            }
            ?>

        </div>
    </div>

</div>