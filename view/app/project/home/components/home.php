<?php
// Taches :
$taskTabs = $task -> getTabs( $router -> getRouteParam('2') );


?>


<?php require_once ('view/app/project/components/project_sidebar.php') ?>

<div class="content_wrapper">
    <div class="container-fluid zone_container">
        <div class="row d-flex justify-content-between">
            <div class="col-lg-8 col-md-6 col-12 zone_item">
                <div class="content light-border p-3">
                    <div class="heading mr-bot"> <span class="color-dark text-sm">Vos tâches non-terminées assignées</span> </div>
                    <div class="body">
                        <div><?= $taskTabs['count'] ?> Tableau</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12 zone_item">
                <div class="content light-border p-3">
                    <div class="heading mr-bot"> <span class="color-dark text-sm">Les tableaux et leur tâches</span> </div>
                    <div class="body tab_task-pr-slide">
                        <?php
                        foreach($taskTabs['content'] as $tab){
                            $tasks = $task -> getTabTasks($tab['tab_token']);

                            $tabTasks_working = $dashboard -> getTabTasksPerStatus($router -> getRouteParam('2'), $tab['tab_token'], 'working');
                            $tabTasks_late = $dashboard -> getTabTasksPerStatus($router -> getRouteParam('2'), $tab['tab_token'], 'late');
                            $tabTasks_ended = $dashboard -> getTabTasksPerStatus($router -> getRouteParam('2'), $tab['tab_token'], 'ended');

                            ?>
                            <div class="tab_task-pr-slide-item">
                                <?php
                                if($tasks['count'] !== 0){
                                    ?>
                                    <div class="text-align-center mr-top"> <h3 class="color-dark text-sm"><?= $tab['name'] ?> (<?= $tasks['count'] ?>)</h3> </div>
                                    <canvas 
                                        id="tab_task-pr-<?= $tab['tab_token']?>" width="200" height="200" 
                                        data-aCount="<?= $tabTasks_working['count'] ?>" 
                                        data-bCount="<?= $tabTasks_late['count'] ?>" 
                                        data-cCount="<?= $tabTasks_ended['count'] ?>"
                                    > </canvas>
                                    <script>
                                        // Tableaux de taches et leur contenu
                                        var ctx = document.getElementById("tab_task-pr-<?= $tab['tab_token']?>");

                                        var myChart = new Chart(ctx, {
                                            type: 'pie',
                                            data: {
                                                labels: [<?= ($tabTasks_working['count'] !== 0) ? '\'En cours \',' : '' ?> <?= ($tabTasks_late['count'] !== 0) ? '\'En retard\',' : '' ?> <?= ($tabTasks_ended['count'] !== 0) ? '\'Terminé \'' : '' ?>],
                                                datasets: [{
                                                label: 'Les tâches',
                                                data: [<?= ($tabTasks_working['count'] !== 0) ? 'ctx.getAttribute("data-aCount"),' : '' ?> <?= ($tabTasks_late['count'] !== 0) ? 'ctx.getAttribute("data-bCount"),' : '' ?> <?= ($tabTasks_ended['count'] !== 0) ? 'ctx.getAttribute("data-cCount")' : '' ?>],
                                                backgroundColor: [
                                                    <?= ($tabTasks_working['count'] !== 0) ? '\'rgba(57, 65, 101, 0.7)\',' : '' ?>
                                                    <?= ($tabTasks_late['count'] !== 0) ? '\'rgba(245, 80, 80, 0.7)\',' : '' ?>
                                                    <?= ($tabTasks_ended['count'] !== 0) ? '\'rgba(76, 108, 246, 0.7)\',' : '' ?>
                                                ],
                                                borderColor: [
                                                    <?= ($tabTasks_working['count'] !== 0) ? '\'rgba(57, 65, 101, 1)\',' : '' ?>
                                                    <?= ($tabTasks_late['count'] !== 0) ? '\'rgba(245, 80, 80, 1)\',' : '' ?>
                                                    <?= ($tabTasks_ended['count'] !== 0) ? '\'rgba(76, 108, 246, 1)\',' : '' ?>
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
                                    <div class="text-align-center mr-top"> <h3 class="color-dark text-sm"><?= $tab['name'] ?> (<?= $tasks['count'] ?>)</h3> </div>
                                    <div class="text-align-center mr-top-lg">
                                        <img src="<?= $config -> rootUrl() ;?>dist/images/illustrations/empty_task_activities.svg" alt="" width="70%">
                                        <h3 class="title-xs bold color-dark mr-bot-lg mr-top-lg">Aucunes données pour ce tableau !</h3>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

