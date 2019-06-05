<div class="navbar-app margin-bot">

    <div class="container_fluid">
        <div class="row navbar-nav">
            <div class="col-md-8 col-12 nav-left">
                <h2 class="title-sm bold color-dark margin-right"> <i class="fas fa-chevron-circle-left margin-right"></i> Calendrier</h2>
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