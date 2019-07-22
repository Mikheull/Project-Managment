<div class="col-lg-4 col-md-6 col-12 zone_item">
    <div class="content light-border p-3">
        <div class="heading mr-bot"> <span class="color-dark text-sm">Gestion des bugs</span> </div>
        <div class="body">
            <?php
                $allBugsLvl1 = $bug -> getBugsPerLevel($router -> getRouteParam('2'), 1);
                $allBugsLvl2 = $bug -> getBugsPerLevel($router -> getRouteParam('2'), 2);
                $allBugsLvl3 = $bug -> getBugsPerLevel($router -> getRouteParam('2'), 3);
                
                if($allBugs['count'] !== 0){
                    ?>
                    <canvas 
                        id="bug-pr" width="200" height="200" 
                        data-level-1="<?= $allBugsLvl1['count'] ?>" 
                        data-level-2="<?= $allBugsLvl2['count'] ?>" 
                        data-level-3="<?= $allBugsLvl3['count'] ?>"
                    >
                    </canvas>
                    <script>
                        // Les bugs
                        var ctx = document.getElementById("bug-pr");

                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: [<?= ($allBugsLvl1['count'] !== 0) ? '\'Non défini \',' : '' ?> <?= ($allBugsLvl2['count'] !== 0) ? '\'En cours\',' : '' ?> <?= ($allBugsLvl3['count'] !== 0) ? '\'Terminé \'' : '' ?>],
                                datasets: [{
                                label: 'Les tâches',
                                data: [<?= ($allBugsLvl1['count'] !== 0) ? 'ctx.getAttribute("data-level-1"),' : '' ?> <?= ($allBugsLvl2['count'] !== 0) ? 'ctx.getAttribute("data-level-2"),' : '' ?> <?= ($allBugsLvl3['count'] !== 0) ? 'ctx.getAttribute("data-level-3")' : '' ?>],
                                backgroundColor: [
                                    <?= ($allBugsLvl1['count'] !== 0) ? '\'rgba(156,54,181, 0.8)\',' : '' ?>
                                    <?= ($allBugsLvl2['count'] !== 0) ? '\'rgba(217,72,15, 0.8)\',' : '' ?>
                                    <?= ($allBugsLvl3['count'] !== 0) ? '\'rgba(43,138,62, 0.8)\',' : '' ?>
                                ],
                                borderColor: [
                                    <?= ($allBugsLvl1['count'] !== 0) ? '\'rgba(156,54,181, 1)\',' : '' ?>
                                    <?= ($allBugsLvl2['count'] !== 0) ? '\'rgba(217,72,15, 1)\',' : '' ?>
                                    <?= ($allBugsLvl3['count'] !== 0) ? '\'rgba(43,138,62, 1)\',' : '' ?>
                                ],
                                borderWidth: 1
                                }]
                            },
                            options: {
                                cutoutPercentage: 40,
                                responsive: true,

                            }
                        });
                    </script>
                    <?php
                }else{
                    ?>
                    <div class="text-align-center mr-top-lg">
                        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_task_activities.svg" alt="" width="70%">
                        <h3 class="title-xs bold color-dark mr-bot-lg mr-top-lg">Aucunes données pour ce graphique !</h3>
                    </div>
                    <?php
                }
            ?>
            
        </div>
    </div>
</div>


<div class="col-lg-8 col-md-6 col-12 zone_item">
    <div class="content light-border p-3">
        <div class="heading mr-bot"> <span class="color-dark text-sm">Vos bugs non-terminées assignées</span> </div>
        <div class="body assigned_task-cont">
            <div class="row">
                <div class="col-md-6 col-12 assigned_part">
                    <h3 class="color-dark text-sm">En équipes</h3>

                    <ul class="pt-3">
                        <?php

                            foreach($allBugsLvl1['content'] as $bug_item){
                                $allMembersAssigned = $bug -> getTeamAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                
                                foreach($allMembersAssigned['content'] as $ms){
                                    if($projectTeam -> memberHasTeam($ms, $main -> getToken()) == true){
                                        ?> 
                                            <li>
                                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker?bug=<?= $bug_item['bug_token'] ?>">
                                                    <div class="pt-3 pb-3 container light-border mr-bot">
                                                        <div class="row">
                                                            <div class="col-10"> <i data-feather="circle" style="color: #9c36b5"></i> <span class="text-sm"><?= $utils -> getData('pr_bug', 'name', 'bug_token', $bug_item['bug_token'] ) ?></span> </div>
                                                            <div class="col-2 text-align-right"> <i data-feather="help-circle" class="color-dark"></i> </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li> 
                                        <?php
                                    }
                                }
                            }
                            foreach($allBugsLvl2['content'] as $bug_item){
                                $allMembersAssigned = $bug -> getTeamAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                
                                foreach($allMembersAssigned['content'] as $ms){
                                    if($projectTeam -> memberHasTeam($ms, $main -> getToken()) == true){
                                        ?> 
                                            <li>
                                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker?bug=<?= $bug_item['bug_token'] ?>">
                                                    <div class="pt-3 pb-3 container light-border mr-bot">
                                                        <div class="row">
                                                            <div class="col-10"> <i data-feather="disc" style="color: #d9480f"></i> <span class="text-sm"><?= $utils -> getData('pr_bug', 'name', 'bug_token', $bug_item['bug_token'] ) ?></span> </div>
                                                            <div class="col-2 text-align-right"> <i data-feather="help-circle" class="color-dark"></i> </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li> 
                                        <?php
                                    }
                                }

                            }
                        ?>
                    </ul>
                </div>

                <div class="col-md-6 col-12 assigned_part">
                    <h3 class="color-dark text-sm">En solo</h3>

                    <ul class="pt-3">
                        <?php

                            foreach($allBugsLvl1['content'] as $bug_item){
                                $allMembersAssigned = $bug -> getMemberAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                
                                foreach($allMembersAssigned['content'] as $ms){
                                    if($ms == $main -> getToken()){
                                        ?> 
                                            <li>
                                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker?bug=<?= $bug_item['bug_token'] ?>">
                                                    <div class="pt-3 pb-3 container light-border mr-bot">
                                                        <div class="row">
                                                            <div class="col-10"> <i data-feather="circle" style="color: #9c36b5"></i> <span class="text-sm"><?= $utils -> getData('pr_bug', 'name', 'bug_token', $bug_item['bug_token'] ) ?></span> </div>
                                                            <div class="col-2 text-align-right"> <i data-feather="help-circle" class="color-dark"></i> </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li> 
                                        <?php
                                    }
                                }
                            }
                            foreach($allBugsLvl2['content'] as $bug_item){
                                $allMembersAssigned = $bug -> getMemberAssigned($router -> getRouteParam('2'), $bug_item['bug_token']);
                                
                                foreach($allMembersAssigned['content'] as $ms){
                                    if($ms == $main -> getToken()){
                                        ?> 
                                            <li>
                                                <a href="<?= $config -> rootUrl() ;?>app/project/<?= $router -> getRouteParam("2") ?>/t/bug-tracker?bug=<?= $bug_item['bug_token'] ?>">
                                                    <div class="pt-3 pb-3 container light-border mr-bot">
                                                        <div class="row">
                                                            <div class="col-10"> <i data-feather="disc" style="color: #d9480f"></i> <span class="text-sm"><?= $utils -> getData('pr_bug', 'name', 'bug_token', $bug_item['bug_token'] ) ?></span> </div>
                                                            <div class="col-2 text-align-right"> <i data-feather="help-circle" class="color-dark"></i> </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li> 
                                        <?php
                                    }
                                }

                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
