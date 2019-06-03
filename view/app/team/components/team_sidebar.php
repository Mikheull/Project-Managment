<div class="navbar-app margin-bot-lg">

    <div class="container">
        <div class="row navbar-nav">
            <div class="col-8 nav-left">
                <h2 class="title-md bold color-primary margin-right"><?= $team -> getTeamData($team_token, 'name') ;?></h2>
                <ul>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/overview"> Overview </a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/members"> Membres </a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/messenger"> Messenger </a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/team/<?= $router -> getRouteParam("2") ?>/settings"> Réglages </a> </li>
                </ul>
            </div>

            <div class="col-4 nav-right">
                <ul class="text-align-right">
                    <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                </ul>
            </div>
        </div>
    </div>

</div>