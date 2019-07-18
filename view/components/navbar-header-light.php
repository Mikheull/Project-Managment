<div class="navbar-header light">

    <div class="container">
        <div class="row navbar">

            <div class="col col-md-2 col-1">
                <a class="navbar-brand" href="<?= $config -> rootUrl() ;?>./" title="Aller a la page d'accueil">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 28">
                        <defs><style>.cls-1,.cls-3{fill:#4c6cf6;}.cls-2{fill:none;stroke:#4c6cf6;stroke-linecap:round;stroke-miterlimit:10;stroke-width:2px;}.cls-3{font-size:16px;font-family:Nunito-Bold, Nunito;font-weight:700;}.cls-4{letter-spacing:-0.01em;}.cls-5{letter-spacing:-0.02em;}</style></defs>
                        <g id="Calque_2" data-name="Calque 2">
                            <g id="Calque_1-2" data-name="Calque 1">
                                <path class="cls-1" d="M26.5,0h-9a1.5,1.5,0,0,0,0,3h5.38L11.5,14.38a1.5,1.5,0,1,0,2.12,2.12L25,5.12V10.5a1.5,1.5,0,0,0,3,0v-9A1.5,1.5,0,0,0,26.5,0Z"/>
                                <path class="cls-2" d="M1,14A13,13,0,0,0,14,27"/>
                                <path class="cls-2" d="M14,27A13,13,0,0,0,27,14"/>
                                <path class="cls-2" d="M14,1A13,13,0,0,0,1,14"/>
                                <text class="cls-3 hidden-md" transform="translate(33.09 19.17)">IMPROOVE</text>
                            </g>
                        </g>
                    </svg>
                </a>
            </div>
            
            <div class="col col-md-10 col-11 navbar-nav">
                <ul class="nav-left">
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>features" title="Découvrir les fonctionnalités">Fonctionnalités</a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>pricing" title="Découvrez nos tarifs">Tarifs</a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>" title="Renseignez vous sur la doc">Documentation</a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app" title="Aller sur la plateforme">App</a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>download" title="Télécharger l'application">Télécharger</a> </li>
                </ul>

                <ul class="nav-right">
                    <?php
                    if($auth -> isConnected() == false){
                    ?>
                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>login" title="Connectez vous">Connexion</a> </li>
                        <li class="nav-item nav-item-btn"> <a href="<?= $config -> rootUrl() ;?>register" title="Inscrivez vous">Inscription</a> </li>
                    <?php
                    }else{
                        ?>
                            <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            
            <div class="col col-md-3 navbar-resp-nav">
                <a class="link" id="resp-nav-header-btn"><i class="fas fa-bars"></i></a>

                <div class="navbar-resp-container">
                    <a class="link light-link title-lg" id="resp-nav-header-close-btn"><i class="far fa-times-circle"></i></a>

                    <div class="menu-wrapper">
                        <div class="row mr-top-lg mr-bot">
                                <?php
                                if($auth -> isConnected() == false){
                                    ?>
                                    <ul class="nav col mr-left">
                                        <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>login" title="Connectez vous" class="link light-link">Connexion</a> </li>
                                        <li class="nav-item nav-item-btn"> <a href="<?= $config -> rootUrl() ;?>register" title="Inscrivez vous" class="link light-link">Inscription</a> </li>
                                    </ul>
                                    <?php
                                }else{
                                    ?>
                                    <ul class="nav col mr-left flex">
                                        <li class="nav-item mr-right notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications" class="link light-link"><i data-feather="bell"></i></a> </li>
                                        <li class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion" class="link light-link"><i data-feather="log-out"></i></a> </li>
                                        <li class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte" class="link light-link"><i data-feather="user"></i></a> </li>
                                    </ul>
                                    <?php
                                }
                                ?>
                        </div>
                        <div class="row mr-top-lg mr-bot">
                            <ul class="nav col mr-left">
                                <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>features" title="Découvrir les fonctionnalités" class="link light-link">Fonctionnalités</a> </li>
                                <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>pricing" title="Découvrez nos tarifs" class="link light-link">Tarifs</a> </li>
                                <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>" title="Renseignez vous sur la doc" class="link light-link">Documentation</a> </li>
                                <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app" title="Aller sur la plateforme" class="link light-link">App</a> </li>
                                <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>download" title="Télécharger l'application" class="link light-link">Télécharger</a> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
                

        </div>
    </div>

</div>

<?php require_once ('view/components/notifications.php') ;?>
