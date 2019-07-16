<?php
    require_once ('controller/project.php') ;
    require_once ('controller/uml.php') ;
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
                                <div class="col-12 margin-top-lg file_container">
                                    <?php
                                        $diagrams = $uml -> getDiagrams( $router -> getRouteParam("2") );
                                        foreach($diagrams['content'] as $diagram){
                                            ?> 
                                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/<?= $diagram['uml_token'] ?>" class="color-lg-black">
                                                    <div class="file_item">
                                                        <div class="body">
                                                            <span>
                                                                <?php
                                                                    if($diagram['type'] == 'flowchart'){
                                                                        ?> Flow <?php
                                                                    }else if($diagram['type'] == 'sequenceDiagram'){
                                                                        ?> Seq <?php
                                                                    }else if($diagram['type'] == 'gantt'){
                                                                        ?> Gantt <?php 
                                                                    }else if($diagram['type'] == 'classDiagram'){
                                                                        ?> Class <?php 
                                                                    }else{
                                                                        ?> <i class="far fa-question-circle"></i> <?php 
                                                                    }
                                                                ?> 
                                                            </span>   
                                                        </div>
                                                        <div class="footer"> <span><?= $diagram['name'] ;?></span> </div>
                                                    </div>
                                                </a>
                                            <?php
                                        }
                                    ?>
                                </div>
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
</div>