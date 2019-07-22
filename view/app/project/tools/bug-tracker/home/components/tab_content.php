<div class="tab-item light-border">
    <div class="container">
        <div class="row mr-top mr-bot">
            <div class="col-12 flex justify-content-between">
                <h3 class="title-xs">Non défini</h3>
                <div style="background: #9c36b5; height: 8px;width: 8px;border-radius: 160px;mr-top: 10px"></div>
            </div>
        </div>
        <div class="row task_container">
            <?php
                $bugsList = $bug -> getBugsPerLevel($project_token, '1');
                foreach($bugsList['content'] as $bug_item){
                    $date_creation = new DateTime( $bug_item['date_creation'] );
                    ?>
                        <div class="col-12 bug_item" data-ref="<?= $bug_item['bug_token'] ?>">
                            <div class="bug_item_content container light-border mr-bot-lg">
                                <div class="row mr-top mr-bot">
                                    <div class="col-10"> 
                                        <h4 class="text-sm">[<span style="color: #9c36b5"><?= $bug_item['bug_token'] ?></span>] - <?= $bug_item['name'] ?></h4> 
                                    </div>

                                    <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                    <div class="col-12 mr-top expand_content hidden">
                                        <div class="color-lg-dark mr-bot"> <?= $bug_item['description'] ?> </div>
                                        <div class="spacebar spacebar-xl"></div>
                                        
                                        <div class="row mr-top mr-bot">
                                            <div class="col-12">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                        </div>


                                        <?php
                                            $allTeamsAssigned = $bug -> getTeamAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                            $allMembersAssigned = $bug -> getMemberAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                            
                                            if($allTeamsAssigned['count'] !== 0){
                                                ?> 
                                                <div class="spacebar spacebar-xl"></div>
                                                <div class="row mr-top mr-bot">
                                                    <div class="col-12 mr-top">
                                                        Équipes assignées :
                                                        <ul>
                                                            <?php 
                                                            foreach($allTeamsAssigned['content'] as $ts){
                                                                ?> <li class="color-lg-dark mr-left"><?= $utils -> getData('pr_project_team', 'name', 'public_token', $ts ) ?></li> <?php
                                                            }
                                                            ?> 
                                                        </ul>
                                                    </div> 
                                                </div> 
                                                <?php
                                            }
                                            if($allMembersAssigned['count'] !== 0){
                                                ?> 
                                                <div class="spacebar spacebar-xl"></div>
                                                <div class="row mr-top mr-bot">
                                                    <div class="col-12 mr-top">
                                                        Membres assignés :
                                                        <ul>
                                                            <?php 
                                                            foreach($allMembersAssigned['content'] as $ms){
                                                                ?> <li class="color-lg-dark mr-left"><?= $utils -> getData('imp_user', 'username', 'public_token', $ms ) ?></li> <?php
                                                            }
                                                            ?> 
                                                        </ul>
                                                    </div> 
                                                </div> 
                                                <?php
                                            }
                                        ?>
                                                            
                                        <div class="spacebar spacebar-xl"></div>
                                        <div class="btn btn-sm light-btn-bordered mr-top text-align-right" data-action="assign_bug" data-ref="<?= $bug_item['bug_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>"><i data-feather="user-plus"></i></div>
                                        <div class="mr-top text-align-right link" style="color: #d9480f" id="move-to-working" data-bug="<?= $bug_item['bug_token'] ?>" data-pro="<?= $project_token ?>">En cours <i class="fas fa-arrow-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="tab-item light-border">
    <div class="container">
        <div class="row mr-top mr-bot">
            <div class="col-12 flex justify-content-between">
                <h3 class="title-xs">En cours</h3>
                <div style="background: #d9480f; height: 8px;width: 8px;border-radius: 160px;mr-top: 10px"></div>
            </div>
        </div>
        <div class="row task_container">
            <?php
                $bugsList = $bug -> getBugsPerLevel($project_token, '2');
                foreach($bugsList['content'] as $bug_item){
                    $date_creation = new DateTime( $bug_item['date_creation'] );
                    $date_working = new DateTime( $bug_item['date_working'] );

                    ?>
                        <div class="col-12 bug_item" data-ref="<?= $bug_item['bug_token'] ?>">
                            <div class="bug_item_content container light-border mr-bot-lg">
                                <div class="row mr-top mr-bot">
                                    <div class="col-10"> 
                                        <h4 class="text-sm">[<span style="color: #d9480f"><?= $bug_item['bug_token'] ?></span>] - <?= $bug_item['name'] ?></h4> 
                                    </div>

                                    <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                    <div class="col-12 mr-top expand_content hidden">
                                        <div class="color-lg-dark mr-bot"> <?= $bug_item['description'] ?> </div>
                                        <div class="spacebar spacebar-xl"></div>
                                        
                                        <div class="row mr-top mr-bot">
                                            <div class="col-12">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                            <div class="col-12 mr-top">"En cours" le : <span class="color-lg-dark"><?= date_format($date_working, 'd/m/Y à H:i') ;?></span> </div>
                                        </div>


                                        <?php
                                            $allTeamsAssigned = $bug -> getTeamAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                            $allMembersAssigned = $bug -> getMemberAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                            
                                            if($allTeamsAssigned['count'] !== 0){
                                                ?> 
                                                <div class="spacebar spacebar-xl"></div>
                                                <div class="row mr-top mr-bot">
                                                    <div class="col-12 mr-top">
                                                        Équipes assignées :
                                                        <ul>
                                                            <?php 
                                                            foreach($allTeamsAssigned['content'] as $ts){
                                                                ?> <li class="color-lg-dark mr-left"><?= $utils -> getData('pr_project_team', 'name', 'public_token', $ts ) ?></li> <?php
                                                            }
                                                            ?> 
                                                        </ul>
                                                    </div> 
                                                </div> 
                                                <?php
                                            }
                                            if($allMembersAssigned['count'] !== 0){
                                                ?> 
                                                <div class="spacebar spacebar-xl"></div>
                                                <div class="row mr-top mr-bot">
                                                    <div class="col-12 mr-top">
                                                        Membres assignés :
                                                        <ul>
                                                            <?php 
                                                            foreach($allMembersAssigned['content'] as $ms){
                                                                ?> <li class="color-lg-dark mr-left"><?= $utils -> getData('imp_user', 'username', 'public_token', $ms ) ?></li> <?php
                                                            }
                                                            ?> 
                                                        </ul>
                                                    </div> 
                                                </div> 
                                                <?php
                                            }
                                        ?>
                                                            
                                        <div class="spacebar spacebar-xl"></div>
                                        <div class="btn btn-sm light-btn-bordered mr-top text-align-right" data-action="assign_bug" data-ref="<?= $bug_item['bug_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>"><i data-feather="user-plus"></i></div>
                                        <div class="mr-top text-align-right link" style="color: #2b8a3e" id="move-to-end" data-bug="<?= $bug_item['bug_token'] ?>" data-pro="<?= $project_token ?>">Terminé <i class="fas fa-arrow-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<div class="tab-item light-border">
    <div class="container">
        <div class="row mr-top mr-bot">
            <div class="col-12 flex justify-content-between">
                <h3 class="title-xs">Terminé</h3>
                <div style="background: #2b8a3e; height: 8px;width: 8px;border-radius: 160px;mr-top: 10px"></div>
            </div>
        </div>
        <div class="row task_container">
            <?php
                $bugsList = $bug -> getBugsPerLevel($project_token, '3');
                foreach($bugsList['content'] as $bug_item){
                    $date_creation = new DateTime( $bug_item['date_creation'] );
                    $date_working = new DateTime( $bug_item['date_working'] );
                    $date_end = new DateTime( $bug_item['date_end'] );
                    ?>
                        <div class="col-12 bug_item" data-ref="<?= $bug_item['bug_token'] ?>">
                            <div class="bug_item_content container light-border mr-bot-lg">
                                <div class="row mr-top mr-bot">
                                    <div class="col-10"> 
                                        <h4 class="text-sm">[<span style="color: #2b8a3e"><?= $bug_item['bug_token'] ?></span>] - <?= $bug_item['name'] ?></h4> 
                                    </div>

                                    <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                        <div class="col-12 mr-top expand_content hidden">
                                        <div class="color-lg-dark mr-bot"> <?= $bug_item['description'] ?> </div>
                                        <div class="spacebar spacebar-xl"></div>
                                        
                                        <div class="row mr-top mr-bot">
                                            <div class="col-12">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                            <div class="col-12 mr-top">"En cours" le : <span class="color-lg-dark"><?= date_format($date_working, 'd/m/Y à H:i') ;?></span> </div>
                                            <div class="col-12 mr-top">Terminé le : <span class="color-lg-dark"><?= date_format($date_end, 'd/m/Y à H:i') ;?></span> </div>
                                        </div>


                                        <?php
                                            $allTeamsAssigned = $bug -> getTeamAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                            $allMembersAssigned = $bug -> getMemberAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                            
                                            if($allTeamsAssigned['count'] !== 0){
                                                ?> 
                                                <div class="spacebar spacebar-xl"></div>
                                                <div class="row mr-top mr-bot">
                                                    <div class="col-12 mr-top">
                                                        Équipes assignées :
                                                        <ul>
                                                            <?php 
                                                            foreach($allTeamsAssigned['content'] as $ts){
                                                                ?> <li class="color-lg-dark mr-left"><?= $utils -> getData('pr_project_team', 'name', 'public_token', $ts ) ?></li> <?php
                                                            }
                                                            ?> 
                                                        </ul>
                                                    </div> 
                                                </div> 
                                                <?php
                                            }
                                            if($allMembersAssigned['count'] !== 0){
                                                ?> 
                                                <div class="spacebar spacebar-xl"></div>
                                                <div class="row mr-top mr-bot">
                                                    <div class="col-12 mr-top">
                                                        Membres assignés :
                                                        <ul>
                                                            <?php 
                                                            foreach($allMembersAssigned['content'] as $ms){
                                                                ?> <li class="color-lg-dark mr-left"><?= $utils -> getData('imp_user', 'username', 'public_token', $ms ) ?></li> <?php
                                                            }
                                                            ?> 
                                                        </ul>
                                                    </div> 
                                                </div> 
                                                <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <?php
                }
            ?>
        </div>
    </div>
</div>




<script>

// Assign
$(document).on("click", "[data-action='assign_bug']", function(e) {
    let ref = this.dataset.ref;
    let project = this.dataset.pro;

    bootbox.dialog({
        backdrop: true,
        closeButton: false,
        title: "Assigner le rapport de bug",
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
                        url:  rootUrl + 'controller/ajax/project/bug/bug_short-actions.php',
                        type: 'POST',
                        data: {assigned_teams: assigned_teams, assigned_members: assigned_members, bug_token: ref, project_token: project, action: 'assign_bug'},
                        success:function(data){
                            $('#bug_output').html(data);
                        }
                    });
                   
                }
            },
            cancel: {
                label: 'Annuler',
                className: 'btn dark-btn',
            }
        },
        message: '<div class="row"> <div class="mr-bot-lg col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des équipes</h3> <?php require_once ("controller/projectTeam.php"); $teams=$projectTeam -> getTeams( $router -> getRouteParam("2") ); foreach($teams["content"] as $t){?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_teams" value="<?=$t["public_token"] ;?>" id="<?=$t["public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?=$t["public_token"] ;?>"></label> </div><div> <small><?=$t["name"] ;?></small> </div></div><?php } ?> </div><div class="col-12"> <h3 class="text-sm color-dark mr-bot mr-top">Assigner des membres</h3> <?php require_once ("controller/project.php"); $teams=$project -> getProjectMembers( $router -> getRouteParam("2") ); foreach($teams["content"] as $t){?> <div class="tg-list-item flex mr-bot"> <div class="mr-right"> <input class="tgl tgl-light" name="assigned_members" value="<?=$t["user_public_token"] ;?>" id="<?=$t["user_public_token"] ;?>" type="checkbox"/> <label class="tgl-btn" for="<?=$t["user_public_token"] ;?>"></label> </div><div> <small><?=$utils -> getData('imp_user', 'username', 'public_token', $t["user_public_token"] ) ;?></small> </div></div><?php } ?> </div></div>',
        
    });
});
</script>