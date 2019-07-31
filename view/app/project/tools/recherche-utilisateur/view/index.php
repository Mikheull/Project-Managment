<?php
    require_once ('controller/project.php') ;
    require_once ('controller/recherche_utilisateur.php') ;
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
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="link dark-link"> <i data-feather="arrow-left"></i> Retour </a> </li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.view')){
                if($recherche_utilisateur -> etudeExist($router -> getRouteParam("5"))){
                    require_once ('view/app/project/tools/recherche-utilisateur/view/components/home.php');
                }else{
                    require_once ('view/app/project/tools/recherche-utilisateur/view/components/not-found.php');
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

<?php require_once ('view/app/project/components/footer.php') ?>