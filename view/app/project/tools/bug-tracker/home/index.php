<?php
    require_once ('controller/project.php') ;
    require_once ('controller/bug.php') ;
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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="link dark-link active"> Bugs </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker/reports" class="link dark-link"> Rapports </a> </li>
                        </ul>
                    </div>
                </div>
            </div>


            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'bug-tracker.view')){
                $project_token = $router -> getRouteParam('2');
                ?>
                <div class="row mr-bot">
                    <div class="btn btn-sm primary-btn" id="new-bug" data-pro="<?= $router -> getRouteParam('2') ?>"><i class="fas fa-plus"></i> Nouveau bug</div>
                </div>

                <div class="row tabs" id="bug_output">
                    <?php require_once ('view/app/project/tools/bug-tracker/home/components/tab_content.php') ;?>
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

</div>