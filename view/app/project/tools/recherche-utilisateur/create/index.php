<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
    
    $allResearchs = $recherche_utilisateur -> getEtudes( $router -> getRouteParam('2') );
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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="link dark-link"> Home </a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/create" class="link dark-link active"> Nouveau </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.create')){
                ?>

                    <div>
                        <h3 class="title-sm bold color-dark mr-top mr-bot">Créer une étude</span></h3>
                    </div>
                    <form method="POST">
                        <div class="input_group">
                            <div class="input-field input-half">
                                <label for="name">Nom</label>
                                <input type="text" name="name" id="name" placeholder="Nom" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>">
                            </div>
                        </div>

                        <div class="input_group">
                            <div class="input-field input-half-al">
                                <label for="topic">Topic</label>
                                <textarea name="topic" id="topic" placeholder="Description"><?= isset($_POST['topic']) ? $_POST['topic'] : '' ?></textarea>
                            </div>
                        </div>

                        <button class="btn primary-btn" name="create_research">Créer l'étude</button>
                    </form>
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