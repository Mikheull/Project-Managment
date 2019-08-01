<?php
// Les variables $event_token et $project_token sont définies en AJAX !

$date1 = new DateTime();
$date2 = new DateTime( $utils -> getData('pr_task_item', 'deadline', 'task_token', $event_token ) );
$interval = $date1->diff($date2);
$date_creation = new DateTime( $utils -> getData('pr_task_item', 'date_creation', 'task_token', $event_token ) );

?>
<div class="container" id="event-content">
    <div id="event-if" data-ref="<?= $event_token ?>" data-pro="<?= $project_token ?>"></div>
    <div id="task-if" data-ref="<?= $event_token ?>" data-pro="<?= $project_token ?>"></div>

    <div class="row">
        <div class="col-md-6 offset-md-3 col-10 offset-1 event_popup">

            <div class="container pt-2">

                <div class="row head">
                    <div class="col-12 flex justify-content-between">
                        <h3 class="title-sm bold color-lg-dark"><?= stripslashes($utils -> getData('pr_task_item', 'name', 'task_token', $event_token )) ?></h3>
                        <a class="link color-lg-dark" id="close-event-popup"><i class="far fa-times-circle"></i></a>
                    </div>
                    <div class="col-12 flex justify-content-between">
                        <span class="text-xs">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span></span>

                        <?php
                            if($utils -> getData('pr_task_item', 'date_end', 'task_token', $event_token ) == NULL){
                                ?><div class="link primary-link" data-action="close_task"><i data-feather="eye-off"></i> Terminer </div><?php
                            }else{
                                ?><div class="link primary-link" data-action="reopen_task"><i data-feather="eye"></i> Réouvrir </div><?php
                            }
                        ?>
                    </div>
                </div>    

                <div class="row">
                    <div class="col-md-9 col-10 head_menu mr-top">
                        <ul>
                            <li class="mr-3 active" data-page="informations"> <a class="link">Informations</a> </li>
                            <li class="mr-3" data-page="timer"> <a class="link">Timer</a> </li>
                            <li class="mr-3" data-page="activity"> <a class="link">Activité</a> </li>
                            <li class="mr-3" data-page="assigned_members"> <a class="link">Membres assignés</a> </li>
                            <li class="" data-page="assigned_teams"> <a class="link">Équipes assignées</a> </li>
                        </ul>
                    </div>
                    <div class="col-md-3 col-2 head_settings mr-top">
                        <ul>
                            <li class="mb-2"> <div class="link dark-link" data-action="assign_task"><i data-feather="user-plus"></i> <span class="md-hide">Assigner</span> </div> </li>
                            <li class="mb-2"> <div class="link dark-link" data-action="edit_task"><i data-feather="edit"></i> <span class="md-hide">Modifier</span> </div> </li>
                            <li class="mb-2"> <a href="gestion-projet?task=<?= $event_token ?>" class="link dark-link"><i data-feather="link"></i> <span class="md-hide">Lien</span> </a> </li>
                            <li class="mb-2"> <div class="link red-link" data-action="delete_task"><i data-feather="trash-2"></i> <span class="md-hide">Supprimer</span> </div> </li>
                        </ul>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-12 menu-content">
                        <div id="informations" class="page_el">
                            <div>Durée prévue : <span class="color-lg-dark"><?= $utils -> getData('pr_task_item', 'duration', 'task_token', $event_token ) ;?></span> </div>
                            <div class="mr-bot">Durée : <span class="color-lg-dark"><?= $task -> getTaskTimer($project_token, $event_token) ?></span> </div>
                            <div>Fin prévu le : <span class="color-lg-dark"><?= date_format($date2, 'd/m/Y') ;?></span> </div>
                            <?php
                            if($utils -> getData('pr_task_item', 'date_end', 'task_token', $event_token ) !== NULL){
                                $date_end = new DateTime( $utils -> getData('pr_task_item', 'date_end', 'task_token', $event_token ) );
                                ?> <div class="mr-bot">Terminée le : <span class="color-lg-dark"><?= date_format($date_end, 'd/m/Y à H:i') ;?></span> </div> <?php
                            }else{
                                if($date1 > $date2){
                                    ?> <span class="color-red">En retard de <?= $interval->days ?> jour<?= ($interval->days > 1 ? 's' : '') ;?></span> <?php
                                }
                            }
                            ?>
                        </div>

                        <div id="timer" class="page_el hidden">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 mr-bot">
                                        <?php
                                            if($utils -> getData('pr_task_item', 'date_end', 'task_token', $event_token ) == NULL){
                                                if($task -> timerIsLaunched($project_token) == true){
                                                    $task_timer_id = $task -> getLastTimer($project_token);
                                                    $task_timer_token = $utils -> getData('pr_task_timer', 'task_token', 'ID', $task_timer_id );
                                                    $date_begin = new DateTime( $utils -> getData('pr_task_timer', 'date_creation', 'ID', $task_timer_id ) );
                                                    $date_end = new DateTime();
                                                    // $date_end->add(new DateInterval('PT2H'));
                                                    if($task_timer_token == $event_token){
                                                        ?> 
                                                            <div class="flex">
                                                                <a class="btn-pause link"> <i class="fas fa-pause"></i> </a>
                                                                <span class="ml-2 mt-2 text-sm color-red">Pour arreter le timer cliquez en haut</span>
                                                            </div>
                                                        <?php
                                                    }
                                                }else{
                                                    ?> 
                                                        <div class="flex">
                                                            <a class="btn-play link" data-action="launch-timer" data-ref="<?= $event_token ?>" data-pro="<?= $project_token ?>"> <i class="fas fa-play"></i> </a>
                                                            <a class="btn-pause link hidden" data-action="stop-timer" data-ref="<?= $event_token ?>" data-pro="<?= $project_token ?>"> <i class="fas fa-pause"></i> </a>
                                                            <span class="ml-2 mt-2 text-sm color-red">Lancer le timer</span>
                                                        </div>
                                                    <?php
                                                }
                                            }else{
                                                ?> 
                                                <span class="bold text-sm color-lg-dark">Cette tâche est terminée !</span>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <div class="col-12">
                                        <ul class="list-timers">
                                            <?php
                                                $allTasksTimers = $task -> getAllTasksTimers($project_token, $event_token);
                                                foreach($allTasksTimers['content'] as $timer){
                                                    ?>
                                                        <li class="mr-bot">
                                                            <div class="flex">
                                                                <div class="avatar avatar--md mr-right"> 
                                                                    <figure class="avatar__figure" role="img">
                                                                        <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                                        <img class="avatar__img" src="../../../../dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $timer['user_token']) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $timer['user_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $timer['user_token']) ;?>">
                                                                    </figure>
                                                                </div>
                                                                <span class="mt-1 color-lg-dark"> <?= $utils -> getData('imp_user', 'username', 'public_token', $timer['user_token'] ) ?> </span>
                                                                <span class="mt-1 mr-left bold color-lg-dark"><?= $utils -> getData('pr_task_timer', 'time_duration', 'ID', $timer['ID'] ) ?></span>
                                                            </div>
                                                        </li>
                                                    <?php
                                                }

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="activity" class="page_el hidden">
                            <ul class="list-activity">
                                <?php
                                $task_activity = $activity -> getActivity($project_token, $event_token);
                                if($task_activity['count'] !== 0){
                                    foreach($task_activity['content'] as $act_item){
                                        $date = new DateTime( $act_item['date'] );
                                        ?>
                                        <li class="mr-bot">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-8 flex">
                                                        <div class="avatar avatar--md mr-right"> 
                                                            <figure class="avatar__figure" role="img">
                                                                <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                                <img class="avatar__img" src="../../../../dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $act_item['user_public_token']) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $act_item['user_public_token'].'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $act_item['user_public_token']) ;?>">
                                                            </figure>
                                                        </div>
                                                        <span class="mt-1 color-lg-dark"> <?= $utils -> getData('imp_user', 'username', 'public_token', $act_item['user_public_token'] ) ?>
                                                            <?php
                                                                if($act_item['type'] == 'create-task'){
                                                                    ?> <span> à créer la tâche </span><?php
                                                                }
                                                                if($act_item['type'] == 'edit-task'){
                                                                    ?> <span> à modifier la tâche </span><?php
                                                                }
                                                                if($act_item['type'] == 'close-task'){
                                                                    ?> <span> à clos la tâche </span><?php
                                                                }
                                                                if($act_item['type'] == 'reopen-task'){
                                                                    ?> <span> à réouvert la tâche </span><?php
                                                                }
                                                                if($act_item['type'] == 'launch-timer-task'){
                                                                    ?> <span> à commencé a travailler sur la tâche </span><?php
                                                                }
                                                                if($act_item['type'] == 'stop-timer-task'){
                                                                    ?> <span> à travaillé pendant <?= $act_item['optional'] ?> sur la tâche </span><?php
                                                                }
                                                                if($act_item['type'] == 'assign-team-task'){
                                                                    $teams = explode('|', $act_item['optional']);
                                                                    ?> 
                                                                        <span> à assigner la tâche aux équipes :</span>
                                                                        <ul>
                                                                            <?php
                                                                            foreach($teams as $t){
                                                                                if($t !== ''){
                                                                                    ?> <li>- <?= $utils -> getData('pr_project_team', 'name', 'public_token', $t ) ?></li> <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    <?php
                                                                }
                                                                if($act_item['type'] == 'assign-member-task'){
                                                                    $members = explode('|', $act_item['optional']);
                                                                    ?> 
                                                                        <span> à assigner la tâche aux membres :</span>
                                                                        <ul>
                                                                            <?php
                                                                            foreach($members as $m){
                                                                                if($m !== ''){
                                                                                    ?> <li>- <?= $utils -> getData('imp_user', 'username', 'public_token', $m ) ?></li> <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </ul>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-8 ml-5">
                                                        <span class="color-gray text-xs"> le <?= date_format($date, 'd/m/Y à H:i') ;?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="spacebar mr-top"><div class="spacebar-lg"></div></div>
                                        </li>
                                            
                                        <?php
                                        
                                    }
                                }else{
                                    ?>Aucune activité pour cette tâche<?php
                                }
                                ?>
                            </ul>
                        </div>

                        <div id="assigned_members" class="page_el hidden">
                            <?php
                                $allMembersAssigned = $task -> getAllMemberAssigned($project_token, $event_token);
                                if($allMembersAssigned['count'] !== 0){
                                    ?> 
                                    <ul>
                                        <?php 
                                        foreach($allMembersAssigned['content'] as $ms){
                                            if($ms !== ''){
                                                ?> 
                                                <li class="mr-bot color-lg-dark flex">
                                                    <div class="avatar avatar--md mr-right"> 
                                                        <figure class="avatar__figure" role="img">
                                                            <svg class="avatar__placeholder" aria-hidden="true" viewBox="0 0 20 20" stroke-linecap="round" stroke-linejoin="round"><circle cx="10" cy="6" r="2.5" stroke="currentColor"/><path d="M10,10.5a4.487,4.487,0,0,0-4.471,4.21L5.5,15.5h9l-.029-.79A4.487,4.487,0,0,0,10,10.5Z" stroke="currentColor"/></svg>
                                                            <img class="avatar__img" src="../../../../dist/<?= $utils -> getData('imp_user', 'profil_image', 'public_token', $ms) == NULL ? 'images/content/defaut_profil_pic.jpg' : 'uploads/u/'. $ms.'/profil_pic/'.$utils -> getData('imp_user', 'profil_image', 'public_token', $ms) ;?>">
                                                        </figure>
                                                    </div>
                                                    <span class="mt-1 color-lg-dark"> <?= $utils -> getData('imp_user', 'username', 'public_token', $ms ) ?> </span>
                                                </li> 
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </ul>
                                    <?php
                                }else{
                                    ?> 
                                    <span class="bold text-sm color-lg-dark">Aucun membre assigné !</span>
                                    <?php
                                }
                            ?>
                        </div>

                        <div id="assigned_teams" class="page_el hidden">
                            <?php
                                $allTeamsAssigned = $task -> getAllTeamAssigned($project_token, $event_token);
                                if($allTeamsAssigned['count'] !== 0){
                                    ?> 
                                    <ul>
                                        <?php 
                                        foreach($allTeamsAssigned['content'] as $ts){
                                            if($ts !== ''){
                                                ?> 
                                                <li class="color-lg-dark flex">
                                                    <span> <?= $utils -> getData('pr_project_team', 'name', 'public_token', $ts ) ?> </span>
                                                </li> 
                                                <?php
                                            }
                                        }
                                        ?> 
                                    </ul>
                                    <?php
                                }else{
                                    ?> 
                                    <span class="bold text-sm color-lg-dark">Aucune équipe assigné !</span>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    feather.replace()
});


// Assign task
$(document).on("click", "[data-action='assign_task']", function(e) {
    var ctx = document.getElementById("event-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Assigner la tâche",
        buttons: {
            confirm: {
                label: 'Ok',
                className: 'btn primary-btn',
                callback: function(){
                    let assigned_teams = [];
                    let assigned_members = [];
                    $("input:checkbox[name=assigned_teams]:checked").each(function(){ assigned_teams.push($(this).val()); });
                    $("input:checkbox[name=assigned_members]:checked").each(function(){ assigned_members.push($(this).val()); });
                    
                    $.ajax({
                        url:  rootUrl + 'controller/ajax/project/task/task_short-actions.php',
                        type: 'POST',
                        data: {assigned_teams: assigned_teams, assigned_members: assigned_members, task_token: ref, project_token: project, action: 'assign_task'},
                        success:function(data){
                            $('#calendar_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<div class="row"> <div class="mr-bot-lg col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des équipes</h3> <?php require_once ("controller/projectTeam.php"); $teams = $projectTeam -> getTeams( $project_token ); foreach($teams["content"] as $t){ ?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_teams" value="<?= $t["public_token"] ;?>" id="<?= $t["public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?= $t["public_token"] ;?>"></label> </div><div> <small><?= $t["name"] ;?></small> </div></div><?php } ?> </div><div class="col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des membres</h3> <?php require_once ("controller/project.php"); $teams=$project -> getProjectMembers( $project_token ); foreach($teams["content"] as $t){ ?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_members" value="<?= $t["user_public_token"] ;?>" id="<?= $t["user_public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?= $t["user_public_token"] ;?>"></label> </div><div> <small><?= $utils -> getData('imp_user', 'username', 'public_token', $t["user_public_token"] ) ;?></small> </div></div><?php } ?> </div></div>',
        
    });
});
</script>
