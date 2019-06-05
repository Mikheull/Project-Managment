<div class="navbar-app margin-bot-lg">

    <div class="container">
        <div class="row navbar-nav nav-border-bot">
            <div class="col-8 nav-left">
                <h2 class="title-md bold color-primary"><?= $team -> getTeamData($team_token, 'name') ;?></h2>
            </div>

            <div class="col-4 nav-right">
                <ul class="text-align-right">
                    <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                </ul>
            </div>
        </div>


        <div class="row navbar-nav">
            <div class="col-6 nav-left">
                <ul class="margin-top">
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/overview" class="dark-link"> Overview </a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/members" class="dark-link"> Membres </a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/messenger" class="dark-link"> Messenger </a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/settings" class="dark-link"> Réglages </a> </li>
                </ul>
            </div>
            
            <div class="col-6 nav-right">
                <div class="margin-top-lg text-align-right">
                    <a href="" data-action="invite" data-ref="<?= $router -> getRouteParam("2") ?>" class="margin-left btn btn-sm primary-btn"> <i class="fas fa-plus-circle"></i> Inviter</a>
                </div>
            </div>
        </div>
    </div>

</div>