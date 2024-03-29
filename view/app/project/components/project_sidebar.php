<?php
function TimeToSec($time) {
    $sec = 0;
    foreach (array_reverse(explode(':', $time)) as $k => $v) $sec += pow(60, $k) * $v;
    return $sec;
}

if($task -> timerIsLaunched($project_token) == true){
    $task_timer_id = $task -> getLastTimer($project_token);
    $task_timer_token = $utils -> getData('pr_task_timer', 'task_token', 'ID', $task_timer_id );
    $date_begin = new DateTime( $utils -> getData('pr_task_timer', 'date_creation', 'ID', $task_timer_id ) );
    $date_end = new DateTime();
    // $date_end->add(new DateInterval('PT2H'));

    if($date_begin->format('d') == $date_end->format('d')){
        $dteDiff  = $date_begin->diff($date_end); 
        $second = TimeToSec($dteDiff->format("%H:%I:%S"));
        ?>

        <script>
            $(document).ready(function() {
                $( '#timer-bar' ).toggleClass( 'hidden' );

                var retimer = new easytimer.Timer();
                retimer.start({precision: 'seconds', startValues: {seconds: <?= $second ?>}});

                retimer.addEventListener('secondsUpdated', function (e) {
                    $('#timer-bar #timer-count').html(retimer.getTimeValues().toString());
                });


                // Stop Timer
                $(document).on("click", "[data-action='bar-stop-timer']", function(e) {

                    let ref = this.dataset.ref;
                    let project = this.dataset.pro;
                    let time = retimer.getTimeValues().toString();

                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
                        type: 'POST',
                        data: {task_token: ref, project_token: project, time: time, action: 'stop_timer'},
                        success:function(data){
                            $('#bar-timer_output').html(data);
                            $( '#timer-bar' ).toggleClass( 'hidden' );
                        }
                    });

                    retimer.stop();
                });
             });

        </script>
        
        <?php
    }else{
        echo '['. $task_timer_id .'] on finis le timer sur 00:00:00 parcque +1 jour ('.$date_begin->format('d').' - '.$date_end->format('d').')';
    }

} 
?>
<div id="timer-bar" class="hidden">
    <div>
        <a class="btn-pause link" data-action="bar-stop-timer" data-ref="<?= $task_timer_token ?>" data-pro="<?= $router -> getRouteParam("2") ?>"> <i class="fas fa-pause"></i> </a>
        <span class="mr-left color-light" id="timer-count"></span>
    </div>
    <div>
        <p class="mr-top text-xs color-light">Le timer de la tâche <strong> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet?task=<?= $task_timer_token ?>"><?= $utils -> getData('pr_task_item', 'name', 'task_token', $task_timer_token ) ?></a> </strong> est en cours, arrétez le avant de lancer un nouveau timer ! Un timer ne dépasse pas 24H !</p>
    </div>
</div>

<div class="navbar-app">

    <div class="container-fluid">
        <div class="row navbar-nav nav-border-bot flex justify-content-between">
            <div>
                <div class="nav-item link" id="sidebar_pro-btn"><i data-feather="sidebar"></i></div>
                <div class="nav-item"> <a class="mr-right mr-left bold" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>"><?= $project -> getProjectData($router -> getRouteParam("2"), 'name') ;?></a> </div>
                <div class="nav-item mr-left-lg sm-hide">

                    <?php
                        if(sizeof($router -> getRouteParam("all")) > 3){
                            if($router -> getRouteParam("3") == 'settings'){
                                ?>
                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/settings" class="dark-link"> Réglages </a>
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
                                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/<?= $router -> getRouteParam("4") ?>" class="dark-link"> <?= $page_name ?> </a>
                                <?php
                            }
                        }else{
                            ?>
                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="dark-link"> Dashboard </a>
                            <?php
                        }
                        
                    ?>
                </div>
            </div>

            <div>
                <ul class="text-align-right">
                    <li class="nav-item sm-hide" id="rapid_actions"> <a class="btn btn-sm primary-btn"> <i data-feather="plus-circle"></i></a> </li>
                        
                    <li class="nav-item sm-hide notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item sm-hide mr-right messenger"> 
                        <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" title="messenger"><i data-feather="message-square"></i></a> 
                        <span class="dot"></span>
                    </li>
                    <li class="nav-item sm-hide"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte"><i data-feather="user"></i></a> </li>
                    <li class="nav-item sm-hide"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion"><i data-feather="log-out"></i></a> </li>
                    <li class="nav-item link" id="sidebar_pro-right-btn"> <i data-feather="sidebar" style="transform: rotate(180deg);"></i> </li>
                </ul>
            </div>
        </div>
        
    </div>

</div>



<!-- Ajax -->
<div id="project_output" class="hidden"></div>


<div class="sidebar-project-container">
    <div class="menu-wrapper">
        <div class="row mr-top mr-bot">
            <div class="col col-4 offset-4 mr-top mr-bot">
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
            <ul class="nav col mr-left">
                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/overview_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>" class="gray-link"> Dashboard </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/project_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-projet" class="gray-link"> Gestion de projet </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/team_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/gestion-equipe" class="gray-link"> Gestion d'équipe </a> 
                </li>
                    
                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/messenger_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" class="gray-link"> Messenger </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/calendar_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/calendar" class="gray-link"> Calendrier </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/uml_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/uml" class="gray-link"> UML </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/user_research_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur" class="gray-link"> Recherche utilisateur </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/bug_tracker_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker" class="gray-link"> Bug Tracker </a> 
                </li>

                <li class="nav-item mr-bot flex nav-item-mr"> 
                    <img class="icon mr-right" src="<?= $config -> rootUrl() ;?>dist/images/icons/documents_icon.svg" alt=""> 
                    <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents" class="gray-link"> Documents </a> 
                </li>
            </ul>
            <div class="col-12 bot-lk">
                <a href="<?= $config -> rootUrl() ;?>app" class="btn link gray-link"> <i data-feather="corner-down-left"></i> Changer de projet</a>
            </div>
        </div>
    </div>
</div>




<div class="sidebar-project-container-right">
    <div class="menu-wrapper container">
        <div class="row mr-top mr-bot text-align-center">
            <div class="col-10 offset-1">
                <ul class="d-inline-flex text-align-center">
                    <li class="nav-item mr-right" id="rapid_actions"> <a class="btn btn-sm primary-btn"> <i data-feather="plus-circle"></i></a> </li>
                    <li class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/settings" title="Réglages" class="color-light"><i data-feather="settings"></i></a> </li>
                    <li class="nav-item mr-right notification"> <a href="<?= $config -> rootUrl() ;?>notifications" title="notifications" class="color-light"><i data-feather="bell"></i></a> </li>
                    <li class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/messenger" title="messenger" class="color-light"><i data-feather="message-square"></i></a> </li>
                    <li class="nav-item mr-right"> <a href="<?= $config -> rootUrl() ;?>account" title="Accédez a votre compte" class="color-light"><i data-feather="user"></i></a> </li>
                    <li class="nav-item"> <a href="<?= $config -> rootUrl() ;?>logout" title="Déconnnexion" class="color-light"><i data-feather="log-out"></i></a> </li>
                </ul>

                <div class="spacebar spacebar-light-dark spacebar-lg mt-3 mb-3"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-10 offset-1 sidebar-r-menu">
                <ul>
                    <li class="mr-3 active" data-page="informations"> <a class="link">Informations</a> </li>
                    <li class="mr-3" data-page="members"> <a class="link">Membres</a> </li>
                    <li class="mr-3" data-page="assign"> <a class="link">Assignations</a> </li>
                    <li class="mr-3" data-page="logs"> <a class="link">Logs</a> </li>
                </ul>
            </div>
        </div>


    </div>
</div>




<!-- Menu + Actions -->
<div id="rapid_actions_container" class="hidden">
    <ul class="mr-bot mr-top text-align-left">
        <?php
            $perm_check = false;
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'project.team.member.manage')){
                $perm_check = true
                ?> <li class="nav-item mr-bot" data-action="invite" data-ref="<?= $router -> getRouteParam("2") ?>"> <a class="link dark-link" href="">Invitation</a> </li> <?php
            }
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'calendar.add.event')){
                $perm_check = true
                ?> <li class="nav-item" data-action="new_header_cal_event" data-ref="<?= $router -> getRouteParam("2") ?>"> <a class="link dark-link" href="">Évènement</a> </li> <?php
            }
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'task.create')){
                $perm_check = true
                ?> <li class="nav-item" data-action="new_header_task" data-ref="<?= $router -> getRouteParam("2") ?>"> <a class="link dark-link" href="">Tâche</a> </li> <?php
            }
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'bug-tracker.create')){
                $perm_check = true
                ?> <li class="nav-item" data-action="new_header_bug" data-ref="<?= $router -> getRouteParam("2") ?>"> <a class="link dark-link" href="">Rapport de bug</a> </li> <?php
            }
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'document.create')){
                $perm_check = true
                ?> <li class="nav-item" > <a class="link dark-link" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/documents/create">Document</a> </li> <?php
            }

            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.create')){
                $perm_check = true
                ?> <li class="nav-item mr-top" > <a class="link dark-link" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/create">Étude</a> </li> <?php
            }
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.survey.create')){
                $perm_check = true
                ?> <li class="nav-item" > <a class="link dark-link" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $router -> getRouteParam("5") ?>/survey/create">Sondage</a> </li> <?php
            }
            if($permission -> hasPermission($main -> getToken(), $router -> getRouteParam("2"), 'user-research.affinity.create')){
                $perm_check = true
                ?> <li class="nav-item" > <a class="link dark-link" href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/recherche-utilisateur/<?= $router -> getRouteParam("5") ?>/affinity-diagram/create">Diagramme d'affinité</a> </li> <?php
            }

            if($perm_check == false){
                ?> <li class="nav-item" > <a class="link dark-link">Permissions insuffisante</a> </li> <?php
            }
        ?>
    </ul>
</div>
<script>
    var template = document.getElementById('rapid_actions_container')
    tippy('#rapid_actions', {
        content: template.innerHTML,
        animation: 'fade',
        theme: 'light-border',
        interactive: true,
        placement: 'bottom',
        arrowType: 'round',
        arrow: true,
    })

// Nouveau rapport de bug
$(document).on("click", "[data-action='new_header_task']", function(e) {
    event.preventDefault();
    let ref = this.dataset.ref;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Créer une tâche",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let tab_token = $( 'select[name="tab_token"]' ).val();
                    let task_name = $( 'input[name="task_name"]' ).val();
                    let deadline = $( 'input[name="deadline"]' ).val();
                    let duration = $( 'input[name="duration"]' ).val();
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/task/create_task.php',
                        type: 'POST',
                        data: {task_name: task_name, deadline: deadline, duration: duration, project_token: ref, tab_token: tab_token},
                        success:function(data){
                            $('#tab_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<form method="POST" class="mr-bot-lg"> <div class="container"> <div class="row"> <div class="col-12 input"> <div class="input-field"> <label for="task_name" class="color-dark">Titre de la tâche</label> <input type="text" placeholder="Tache x" name="task_name" id="task_name"> </div></div><div class="col-12 input mr-bot"> <div class="input-field"> <label for="deadline" class="color-dark">Deadline</label> <input type="date" name="deadline" id="deadline"> </div></div><div class="col-12 input mr-bot"> <div class="input-field"> <label for="duration" class="color-dark">Durée</label> <input type="time" name="duration" id="duration" value="01:00"> </div></div><div class="col-12 input mr-bot"> <select name="tab_token"> <option disabled>Aucun</option> <?php require_once ("controller/task.php") ; $tabs=$task -> getTabs( $router -> getRouteParam("2") ); foreach($tabs["content"] as $t){echo "<option value=\"". $t["tab_token"] ."\">". $t["name"] ."</option>";}?> </select> </div></div></div></form>',
        
    });
});
</script>

<?php require_once ('view/components/accept_cookies.php') ;?>