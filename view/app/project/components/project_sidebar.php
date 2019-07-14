<div class="navbar-app">

    <div class="container-fluid">
        <div class="row navbar-nav nav-border-bot">
            <div class="col-md-8 col-12 nav-left">
                <div class="nav-item link" id="sidebar_pro-btn"><i data-feather="sidebar"></i></div>
                <div class="nav-item"> <a class="margin-right-lg margin-left bold" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>"><?= $project -> getProjectData($router -> getRouteParam("2"), 'name') ;?></a> </div>
                <?php
                    if(sizeof($router -> getRouteParam("all")) > 3){
                        if($router -> getRouteParam("3") == 'settings'){
                            ?>
                                <div class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/settings" class="dark-link"> Réglages </a> </div>
                            <?php 
                        }else{
                            if($router -> getRouteParam("4") == 'gestion-projet'){$page_name = 'Gestion de projet' ;}
                            else if($router -> getRouteParam("4") == 'gestion-equipe'){ $page_name = 'Gestion d\'équipe' ; }
                            else if($router -> getRouteParam("4") == 'messenger'){ $page_name = 'Messenger' ; }
                            else if($router -> getRouteParam("4") == 'calendar'){ $page_name = 'Calendrier' ; }
                            else if($router -> getRouteParam("4") == 'uml'){ $page_name = 'UML' ; }
                            else if($router -> getRouteParam("4") == 'recherche-utilisateur'){ $page_name = 'Recherche utilisateur' ; }
                            else if($router -> getRouteParam("4") == 'bug-tracker'){ $page_name = 'Bug tracker' ; }
                            else if($router -> getRouteParam("4") == 'documents'){ $page_name = 'Documents' ; }
                            else{ $page_name = '' ; }
                            ?>
                                <div class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/<?= $router -> getRouteParam("4") ?>" class="dark-link"> <?= $page_name ?> </a> </div>
                            <?php
                        }
                    }else{
                        ?>
                            <div class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"> Dashboard </a> </div>
                        <?php
                    }
                    
                ?>
            </div>

            <div class="col-md-4 col-12 nav-right">
                <ul class="text-align-right">
                    <li class="nav-item" data-action="invite" data-ref="<?= $router -> getRouteParam("2") ?>"> <a href="" class="btn btn-sm primary-btn"> <i data-feather="mail"></i> Inviter</a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/settings" title="Réglages"><i data-feather="settings"></i></a> </li>
                        
                    <li class="nav-item notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte">Mon compte</a> </li>
                </ul>
            </div>
        </div>
        
    </div>

</div>

<div id="project_output" class="hidden"></div>


<div class="sidebar-project-container">
    <div class="menu-wrapper">
        <div class="row margin-top margin-bot">
            <div class="col col-4 offset-4 margin-top margin-bot">
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
            <ul class="nav col margin-left">
                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/overview_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"> Dashboard </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/project_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="dark-link"> Gestion de projet </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/team_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="dark-link"> Gestion d'équipe </a> 
                </li>
                    
                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/messenger_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" class="dark-link"> Messenger </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/calendar_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="dark-link"> Calendrier </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/uml_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="dark-link"> UML </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/user_research_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="dark-link"> Recherche utilisateur </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/bug_tracker_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="dark-link"> Bug Tracker </a> 
                </li>

                <li class="nav-item margin-bot flex nav-item-mr"> 
                    <img class="icon margin-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/documents_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="dark-link"> Documents </a> 
                </li>
            </ul>
            <div class="col-12 bot-lk">
                <a href="<?= $config -> rootUrl() ;?>app" class="btn link light-link"> <i data-feather="corner-down-left"></i> Changer de projet</a>
            </div>
        </div>
    </div>
</div>