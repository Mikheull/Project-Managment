<?php
    require_once ('controller/project.php') ;
    require_once ('controller/uml.php') ;
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/uml/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="link dark-link"> Home </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/create" class="link dark-link"> Nouveau </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/import" class="link dark-link"> Importer </a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-10 col-12">
                <h3 class="title-sm bold color-dark margin-top">Votre diagramme :</h3>
                <h2 class="text-md color-dark margin-bot-lg" id="diagram_name" contenteditable="true"><?= $utils -> getData('pr_uml', 'name', 'uml_token', $router -> getRouteParam("5") ) ?></h2>
            </div>
            <div class="col-md-2 col-12">
                <div class="btn btn-sm dark-btn" onclick="exportSVG(document.getElementById('uml_diagram'));" data-action="export_uml" data-ref="<?= $router -> getRouteParam("5") ?>"><i class="fas fa-download"></i></div>
                <div id="export_btn"></div>
            </div>

        </div>

        <div class="row">
            <div class="mermaid col-md-10 offset-md-1 col-12 offset-12 text-align-center" id="uml_diagram">
                <?= $utils -> getData('pr_uml', 'content', 'uml_token', $router -> getRouteParam("5") ) ?>
            </div>
        </div>

    </div>
</div>