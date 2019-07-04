<?php
    require_once ('controller/project.php') ;
    require_once ('controller/projectTeam.php') ;

    $allTeams = $projectTeam -> getTeams( $router -> getRouteParam('2') );
    
?>



<?php // View Content ?>
<?php require_once ('view/app/components/sidebar.php'); ?>

<div class="container-fluid main_wrapper">
    <?php require_once ('view/app/project/tools/gestion-equipe/components/navbar.php') ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12 navbar-app">
                <div class="navbar-nav">
                    <ul class="text-align-left">
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="link dark-link active"> Équipes </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe/members" class="link dark-link"> Membres </a> </li>
                    </ul>
                </div>
            </div>
        </div>


        <?php
            if($allTeams['count'] !== 0){
                require_once ('view/app/project/tools/gestion-equipe/team/components/home.php');
            }else{
                require_once ('view/app/project/tools/gestion-equipe/team/components/empty.php');
            }
        ?>
    </div>
</div>
