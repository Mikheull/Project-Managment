<?php
    require_once ('controller/project.php') ;
    require_once ('controller/document.php') ;
?>



<?php // View Content ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/components/project_sidebar.php') ?>

    <div class="container">
    <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="link dark-link"> Home </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/create" class="link dark-link active"> Nouveau </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/import" class="link dark-link"> Importer </a> </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <h2 class="title-sm color-dark">Création</h2>
            </div>

            <div class="col-12">
                <form action="" method="post">
                    <div class="input_group">
                        <div class="input-field input-half">
                            <label for="doc_name">Nom</label>
                            <input type="text" name="doc_name" id="doc_name" placeholder="Nom" value="<?= isset($_POST['doc_name']) ? $_POST['doc_name'] : '' ?>">
                        </div>
                    </div>

                    <div class="input_group">
                        <div class="input-field">
                            <textarea name="doc_content" id="doc_content" placeholder="Contenu"></textarea>
                        </div>
                    </div>

                    <button class="btn primary-btn" name="create_doc">Créer</button>
                </form>
            </div>
        </div>
    </div>
</div>