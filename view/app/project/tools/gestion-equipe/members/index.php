<?php
    require_once ('controller/project.php') ;

    $allUsers = $project -> getProjectUser( $router -> getRouteParam('2') );
    
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
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="link dark-link"> Équipes </a> </li>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe/members" class="link dark-link active"> Membres </a> </li>
                    </ul>
                </div>
            </div>
        </div>


        <?php
        if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.team.member.manage')){
            ?>
            <div class="row">
                <?php require_once ('view/app/project/tools/gestion-equipe/members/components/home.php') ?>
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
