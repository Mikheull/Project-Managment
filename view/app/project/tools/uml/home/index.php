<?php
    require_once ('controller/project.php') ;
    require_once ('controller/uml.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="link dark-link active"> Home </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/create" class="link dark-link"> Nouveau </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/import" class="link dark-link"> Importer </a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <?php
                if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.view')){
                    ?>
                        <div class="row tabs" id="tab_output">
                            <ul>
                                <?php
                                    $diagrams = $uml -> getDiagrams( $router -> getRouteParam("2") );
                                    foreach($diagrams['content'] as $diagram){
                                        ?> <li> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/<?= $diagram['uml_token'] ?>"><?= $diagram['name'] ;?></a> </li> <?php
                                    }
                                ?>
                            </ul>
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