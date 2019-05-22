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
                                <text class="cls-3" transform="translate(33.09 19.17)">IMPROOVE</text>
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
                            <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i class="fas fa-bell"></i></a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i class="fas fa-sign-out-alt"></i></a> </li>
                            <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                        <?php
                    }
                    ?>
                    
                </ul>
            </div>
            
            <div class="col col-md-3 navbar-resp-nav">
                <i class="fas fa-bars"></i>
            </div>
                

        </div>
    </div>

</div>

<template id="notifications_tmpl">
    <ul>
        <?php
            if(empty($user -> getUnreadNotifs())){
                echo 'Aucune notifications';
            }else{
                foreach($user -> getUnreadNotifs() as $notif){
                    ?>
                    <li> <a href=""><?= $config -> time_elapsed_string($notif['date'], true) ?> <?= $notif['type'] ?></a> </li>
                    <?php
                }
            }
        ?>
    </ul>
</template>