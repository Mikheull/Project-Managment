
<div class="container">
    <div class="navbar-app">
        <div class="row navbar-nav">
            <div class="col-md-8 col-12 nav-left">
                <ul class="text-align-left">
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"><i class="fas fa-home"></i> <span class="margin-right-lg margin-left bold"><?= $project -> getProjectData($router -> getRouteParam("2"), 'name') ;?></span></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="dark-link"> Messenger </a> </li>
                    <li class="nav-item"> <a class="btn" id="navbar-submenu-btn"><i class="fas fa-ellipsis-h"></i></a> </li>
                </ul>
            </div>

            <div class="col-md-4 col-12 nav-right">
                <ul class="text-align-right">
                    <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php require ('view/app/project/components/menu_list.php') ?>