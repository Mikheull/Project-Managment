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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="link dark-link"> Home </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/create" class="link dark-link"> Nouveau </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
                if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.view')){
                    ?>
                        <div class="row">

                            <div class="col-md-10 col-12">
                                <h3 class="title-sm bold color-dark mr-top">Votre diagramme :</h3>
                                <h2 class="text-md color-dark mr-bot-lg" id="diagram_name" contenteditable="true"><?= $utils -> getData('pr_uml', 'name', 'uml_token', $router -> getRouteParam("5") ) ?></h2>
                            </div>
                            <div class="col-md-2 col-12 flex">
                                <?php if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.export')){ ?>
                                    <div> <div class="btn btn-sm dark-btn mr-right" onclick="exportSVG(document.getElementById('uml_diagram'));" data-action="export_uml" data-ref="<?= $router -> getRouteParam("5") ?>"><i class="fas fa-download"></i></div> </div>
                                    <div id="export_btn"></div>
                                <?php } ?>
                                <?php if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.edit')){ ?>
                                    <div> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml/<?= $router -> getRouteParam("5") ?>/edit" class="btn btn-sm dark-btn mr-right"> <i class="fas fa-edit"></i> </a> </div>
                                <?php } ?>
                                <div> <div class="btn btn-sm dark-btn" id="full_screen"><i class="fas fa-expand"></i></div> </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="mermaid col-md-10 offset-md-1 col-12 offset-12 text-align-center" id="uml_diagram" style="background: #FFF">
                                <?= $utils -> getData('pr_uml', 'content', 'uml_token', $router -> getRouteParam("5") ) ?>
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

<?php require_once ('view/app/project/components/footer.php') ?>


<?php
if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'uml.view')){
    ?>
    <script>
        const el = document.getElementById('uml_diagram');
     
        document.getElementById('full_screen').addEventListener('click', () => {
            if (screenfull.enabled) {
                screenfull.request(el);
            }
        });
    </script>
    <?php
}
?>