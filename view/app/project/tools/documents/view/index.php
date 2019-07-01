<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/documents/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="link dark-link"> Home </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/create" class="link dark-link"> Nouveau </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/import" class="link dark-link"> Importer </a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-md-10 col-12">
                <h3 class="title-sm bold color-dark margin-top">Votre document :</h3>
                <h2 class="text-md color-dark margin-bot-lg" id="doc_name" contenteditable="true"></h2>
            </div>
            <div class="col-md-2 col-12 flex">
                <div> <div class="btn btn-sm dark-btn margin-right"><i class="fas fa-edit"></i></div> </div>
                <div> <div class="btn btn-sm dark-btn" id="full_screen"><i class="fas fa-expand"></i></div> </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-10 offset-md-1 col-12 offset-12 text-align-center" id="doc_content" style="background: #FFF">
                aaa
            </div>
        </div>

    </div>
</div>

<script>
    const el = document.getElementById('doc_content');

    document.getElementById('full_screen').addEventListener('click', () => {
        if (screenfull.enabled) {
            screenfull.request(el);
        }
    });
</script>