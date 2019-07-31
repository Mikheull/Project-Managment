<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;
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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="link dark-link"> Home </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/create" class="link dark-link"> Nouveau </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/import" class="link dark-link active"> Importer </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/share" class="link dark-link"> Partage </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-12 mr-top-lg">
                    <form method="post" enctype="multipart/form-data">
                        <input type="file" class="filepond" name="import_files[]" multiple data-max-file-size="3MB" data-max-files="10" />
                        <button name="import_btn" class="btn btn-sm dark-btn">Importer</button>
                    </form>
                </div>
            </div>

            
        </div>
    </div>
</div>

<?php require_once ('view/app/project/components/footer.php') ?>
