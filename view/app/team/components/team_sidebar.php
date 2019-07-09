<div class="navbar-app margin-bot-lg">

    <div class="container">
        
        <div class="row navbar-nav nav-border-bot">
            <div class="col-md-8 col-12 nav-left">
                <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>" class="dark-link margin-top"><i class="fas fa-home"></i> <span class="margin-right-lg margin-left bold"><?= $utils -> getData('pr_team', 'name', 'public_token', $router -> getRouteParam("2"));?></span></a> 
            </div>

            <div class="col-md-4 col-12 nav-right">
                <ul class="text-align-right">
                    <li class="nav-item" data-action="invite" data-ref="<?= $router -> getRouteParam("2") ?>"> <a href="" class="btn btn-sm primary-btn"> <i class="fas fa-plus-circle"></i> Inviter</a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/settings" title="Réglages"><i data-feather="settings"></i></a> </li>
                        
                    <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                </ul>
            </div>

        </div>
        
    </div>

</div>