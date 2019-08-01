<div id="popup-task-wrapper" class="hidden"></div>

<?php
    
    foreach($tabs['content'] as $t){
        ?>
            <div class="tab-item light-border">
                <div class="container">
                    <div class="row mr-top mr-bot">
                        <div class="col-10"><h3 class="title-sm"><?= $t['name'] ?></h3></div>
                        <div class="col-2 text-align-right"> <i class="fas fa-ellipsis-h" id="act-<?= $t['tab_token'] ?>"></i> </div>
                    </div>

                    <div class="row task_container">
                        <?php
                            $tasks = $task -> getTabTasks($t['tab_token']);
                            foreach($tasks['content'] as $task_item){
                                

                                $date1 = new DateTime();
                                $date2 = new DateTime( $task_item['deadline'] );
                                $interval = $date1->diff($date2);
                                $date_creation = new DateTime( $task_item['date_creation'] );
                                
                                ?>
                                    <div class="col-12 task_item" data-ref="<?= $task_item['task_token'] ?>">
                                        <div class="task_item_content container light-gray-border mr-bot-lg <?= (!isset($task_item['date_end']) ? '' : 'ended') ;?>">
                                            <div class="row mr-top">
                                                <div class="col-12 flex"> 
                                                    <?php
                                                    if(!isset($task_item['date_end'])){
                                                        if($task -> timerIsLaunched($project_token) == true){
                                                            if($task_timer_token == $task_item['task_token']){
                                                                ?> 
                                                                    <a class="btn-pause link"> <i class="fas fa-pause"></i> </a>
                                                                    <h4 class="ml-2 mt-2 text-sm"><?= $task_item['name'] ?></h4>
                                                                <?php
                                                            }
                                                        }else{
                                                            ?> 
                                                                <a class="btn-play link" data-action="launch-timer" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $project_token ?>"> <i class="fas fa-play"></i> </a>
                                                                <a class="btn-pause link hidden" data-action="stop-timer" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $project_token ?>"> <i class="fas fa-pause"></i> </a>
                                                                <h4 class="ml-2 mt-2 text-sm"><?= $task_item['name'] ?></h4>
                                                            <?php
                                                        }
                                                    }else{
                                                        ?> 
                                                        <h4 class="text-sm"><?= $task_item['name'] ?></h4> 
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <div class="col-12 ml-2 mt-2 color-red hidden timer-content">Lancement du timer</div>
                                                <div id="timer_output"></div>
                                            </div>
                                            <div class="row mr-top mr-bot">
                                                <div class="col-10"> 
                                                    
                                                    <?php
                                                        if(isset($task_item['date_end'])){
                                                            $date_end = new DateTime( $task_item['date_end'] );
                                                            $endinterval = $date1->diff($date_end);
                                                            ?> <i data-feather="check-circle" class="color-primary"></i> <span class="color-primary">Terminée il y a <?= $endinterval->days ?> jour<?= ($endinterval->days > 1 ? 's' : '') ;?></span> <?php
                                                        }else{

                                                            if($date1 < $date2){
                                                                ?> <i data-feather="calendar"></i> <span>Dans <?= $interval->days ?> jour<?= ($interval->days > 1 ? 's' : '') ;?></span> <?php
                                                            }else{
                                                                ?> <i data-feather="calendar" class="color-red"></i> <span class="color-red">En retard de <?= $interval->days ?> jour<?= ($interval->days > 1 ? 's' : '') ;?></span> <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>

                                                <div class="col-2 flex">
                                                    <?php
                                                        if($task -> memberIsAssigned($project_token, $task_item['task_token'], $main -> getToken()) == true){
                                                            ?> <div class="text-align-right link mr-2" data-tippy="Vous êtes assigné a cette tâche"> <i data-feather="at-sign" class="color-red"></i> </div> <?php
                                                        }
                                                    ?>
                                                    <div id="popup-task-btn" class="text-align-right link" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $project_token ?>"> <i data-feather="maximize" class="color-lg-dark"></i> </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                        ?>
                        
                    </div>
                    <div class="task-bottom-deco"> <div></div> </div>


                    
                    <div class="row">
                        <div class="col-6 offset-3 btn light-btn-bordered half-width color-primary text-align-center new-task" data-pro="<?= $project_token ?>" data-tab="<?= $t['tab_token'] ?>"><i data-feather="plus-circle"></i> Nouvelle tache</div>
                    </div>
                </div>
            </div>




            <div id="tp-<?= $t['tab_token'] ?>" class="hidden">
                <ul class="mr-top text-align-left">
                    <li> <a data-action="tab-rename" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $project_token ?>" class="link dark-link">Renommer</a> </li>
                    <li> <a data-action="tab-assign" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $project_token ?>" class="link dark-link">Assigner le tableau</a> </li>
                    <li> <a data-action="tab-export" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $project_token ?>" class="link dark-link">Exporter le tableau</a> </li>
                    <li> <a data-action="tab-delete" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $project_token ?>" class="link red-link">Supprimer</a> </li>
                </ul>
            </div>

            <script>
                var template = document.getElementById('tp-<?= $t['tab_token'] ?>')
                tippy('#act-<?= $t['tab_token'] ?>', { content: template.innerHTML, animation: 'fade', theme: 'light-border', interactive: true, placement: 'bottom', arrowType: 'round', arrow: true, })
            </script>
        <?php
    }
?>


<script>

// Assign task
$(document).on("click", "[data-action='assign_task']", function(e) {
    var ctx = document.getElementById("task-if");
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
        message: '<div class="row"> <div class="mr-bot-lg col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des équipes</h3> <?php require_once ("controller/projectTeam.php"); $teams=$projectTeam -> getTeams( $project_token ); foreach($teams["content"] as $t){?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_teams" value="<?=$t["public_token"] ;?>" id="<?=$t["public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?=$t["public_token"] ;?>"></label> </div><div> <small><?=$t["name"] ;?></small> </div></div><?php } ?> </div><div class="col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des membres</h3> <?php require_once ("controller/project.php"); $teams=$project -> getProjectMembers( $project_token ); foreach($teams["content"] as $t){?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_members" value="<?=$t["user_public_token"] ;?>" id="<?=$t["user_public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?=$t["user_public_token"] ;?>"></label> </div><div> <small><?=$utils -> getData('imp_user', 'username', 'public_token', $t["user_public_token"] ) ;?></small> </div></div><?php } ?> </div></div>',
        
    });
});


// Assign tab
$(document).on("click", "[data-action='tab-assign']", function(e) {
    var ctx = document.getElementById("task-if");
    var ref = ctx.getAttribute("data-ref")
    var project = ctx.getAttribute("data-pro")

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Assigner le tableau",
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
                        url:  rootUrl + 'controller/ajax/project/task/tabs_short-actions.php',
                        type: 'POST',
                        data: {assigned_teams: assigned_teams, assigned_members: assigned_members, tab_token: ref, project_token: project, action: 'assign_tab'},
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
        message: '<div class="row"> <div class="mr-bot-lg col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des équipes</h3> <?php require_once ("controller/projectTeam.php"); $teams=$projectTeam -> getTeams( $project_token ); foreach($teams["content"] as $t){?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_teams" value="<?=$t["public_token"] ;?>" id="<?=$t["public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?=$t["public_token"] ;?>"></label> </div><div> <small><?=$t["name"] ;?></small> </div></div><?php } ?> </div><div class="col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des membres</h3> <?php require_once ("controller/project.php"); $teams=$project -> getProjectMembers( $project_token ); foreach($teams["content"] as $t){?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_members" value="<?=$t["user_public_token"] ;?>" id="<?=$t["user_public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?=$t["user_public_token"] ;?>"></label> </div><div> <small><?=$utils -> getData('imp_user', 'username', 'public_token', $t["user_public_token"] ) ;?></small> </div></div><?php } ?> </div></div>',
        
    });
});
</script>
