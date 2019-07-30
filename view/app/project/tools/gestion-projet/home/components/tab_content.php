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
                                                <div id="popup-task-btn" class="col-2 text-align-right link" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $project_token ?>"> <i data-feather="maximize" class="color-lg-dark"></i> </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                        ?>
                    </div>


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
<div class="tab-item">
    <div class="btn primary-btn full-width text-align-center" id="new-tab" data-pro="<?= $project_token ?>"><i data-feather="plus-circle"></i> Nouveau tableau</div>
</div>