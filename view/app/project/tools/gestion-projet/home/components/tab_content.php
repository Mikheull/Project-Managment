<?php
    foreach($tabs['content'] as $t){
        ?>
            <div class="tab-item light-border">
                <div class="container">
                    <div class="row margin-top margin-bot">
                        <div class="col-10"><h3 class="title-sm" id="tab_title-<?= $t['tab_token'] ?>" data-ref="<?= $t['tab_token'] ?>" contenteditable="true" data-pro="<?= $router -> getRouteParam('2') ?>"><?= $t['name'] ?></h3></div>
                        <div class="col-2 text-align-right"> <i class="fas fa-ellipsis-h" id="act-<?= $t['tab_token'] ?>"></i> </div>
                    </div>

                    <div class="row task_container dragscroll">
                        <?php
                            $tasks = $task -> getTabTasks($t['tab_token']);
                            foreach($tasks['content'] as $task_item){
                                

                                $date1 = new DateTime();
                                $date2 = new DateTime( $task_item['deadline'] );
                                $interval = $date1->diff($date2);
                                $date_creation = new DateTime( $task_item['date_creation'] );
                                
                                ?>
                                    <div class="col-12 task_item">
                                        <div class="container light-border margin-bot-lg <?= (!isset($task_item['date_end']) ? '' : 'ended') ;?>">
                                            <div class="row margin-top">
                                                <div class="col"> <h4 class="text-sm"><?= $task_item['name'] ?></h4> </div>
                                            </div>
                                            <div class="row margin-top margin-bot">
                                                <div class="col-10"> 
                                                    
                                                    <?php
                                                        if(isset($task_item['date_end'])){
                                                            $date_end = new DateTime( $task_item['date_end'] );
                                                            $endinterval = $date1->diff($date_end);
                                                            ?> <i class="far fa-check-square color-primary"></i> <span class="color-primary">Terminée il y a <?= $endinterval->days ?> jour<?= ($endinterval->days > 1 ? 's' : '') ;?></span> <?php
                                                        }else{

                                                            if($date1 < $date2){
                                                                ?> <i class="far fa-calendar"></i> <span>Dans <?= $interval->days ?> jour<?= ($interval->days > 1 ? 's' : '') ;?></span> <?php
                                                            }else{
                                                                ?> <i class="far fa-calendar color-red"></i> <span class="color-red">En retard de <?= $interval->days ?> jour<?= ($interval->days > 1 ? 's' : '') ;?></span> <?php
                                                            }
                                                        }
                                                    ?>
                                                </div>
                                                <div class="col-2 text-align-right expand_btn link"><i class="fas fa-chevron-down"></i></div>
                                                
                                                <div class="col margin-top expand_content hidden">
                                                    <div class="container light-border">
                                                        <div class="row margin-top margin-bot">
                                                            <div class="col-12">Durée prévue : <span class="color-lg-dark"><?= $task_item['duration'] ;?></span> </div>
                                                            <div class="col-12 margin-top">Crée le : <span class="color-lg-dark"><?= date_format($date_creation, 'd/m/Y à H:i') ;?></span> </div>
                                                            <div class="col-12 margin-top">Fin prévu le : <span class="color-lg-dark"><?= date_format($date2, 'd/m/Y') ;?></span> </div>
                                                            <?php
                                                                if(isset($task_item['date_end'])){
                                                                    $date_end = new DateTime( $task_item['date_end'] );
                                                                    ?> <div class="col-12 margin-top">Terminée le : <span class="color-lg-dark"><?= date_format($date_end, 'd/m/Y à H:i') ;?></span> </div> <?php
                                                                }
                                                            ?>
                                                            
                                                            <div class="col-12 flex margin-top flex justify-content-between">
                                                                <div>
                                                                    <?php
                                                                    if(!isset($task_item['date_end'])){
                                                                        ?> <div class="btn btn-sm primary-btn" data-action="close_task" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>">Terminer la tâche</div> <?php
                                                                    }else{
                                                                        ?> <div class="btn btn-sm primary-btn" data-action="reopen_task" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>">Réouvrir la tâche</div> <?php
                                                                    }
                                                                    ?>
                                                                </div>

                                                                <div class="flex">
                                                                    <div class="btn btn-sm light-btn-bordered margin-left margin-right" data-action="edit_task" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>"><i class="fas fa-edit"></i></div>
                                                                    <div class="btn btn-sm dark-btn" data-action="delete_task" data-ref="<?= $task_item['task_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>"><i class="far fa-trash-alt"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                <?php
                            }
                        ?>
                    </div>


                    <div class="row">
                        <div class="col-6 offset-3 btn light-btn-bordered half-width color-primary text-align-center new-task" data-pro="<?= $router -> getRouteParam('2') ?>" data-tab="<?= $t['tab_token'] ?>">Nouvelle tache</div>
                    </div>
                </div>
            </div>




            <div id="tp-<?= $t['tab_token'] ?>" class="hidden">
                <ul class="margin-top">
                    <li> <a href="" data-action="tab-rename" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>" class="link dark-link">Renommer</a> </li>
                    <li> <a href="" data-action="tab-export" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>" class="link dark-link">Exporter le tableau</a> </li>
                    <li> <a href="" data-action="tab-delete" data-ref="<?= $t['tab_token'] ?>" data-pro="<?= $router -> getRouteParam('2') ?>" class="link red-link">Supprimer</a> </li>
                </ul>
            </div>

            <script>
                var template = document.getElementById('tp-<?= $t['tab_token'] ?>')
                tippy('#act-<?= $t['tab_token'] ?>', { content: template.innerHTML, animation: 'fade', theme: 'light-border', interactive: true, placement: 'bottom', arrowType: 'round', arrow: true, })
                

                let defautTabName_<?= $t['tab_token'] ?> = $( '#tab_title-<?= $t['tab_token'] ?>' ).html();
                
                $(document).on("focusout", "#tab_title-<?= $t['tab_token'] ?>", function(e) {
                    if($( '#tab_title-<?= $t['tab_token'] ?>' ).html() !== defautTabName_<?= $t['tab_token'] ?>){
                        defautTabName_<?= $t['tab_token'] ?> = $( '#tab_title-<?= $t['tab_token'] ?>' ).html();
                        let ref = this.dataset.ref;
                        let project = this.dataset.pro;
                    
                        $.ajax({
                            url:  rootUrl + 'controller/ajax/project/task/tabs_short-actions.php',
                            type: 'POST',
                            data: {result: defautTabName_<?= $t['tab_token'] ?>, tab_token: ref, project_token: project, action: 'rename'},
                            success:function(data){
                                $('#tab_output').html(data);
                            }
                        });
                    }
                });
            </script>
        <?php
    }
?>
<div class="tab-item">
    <div class="btn primary-btn full-width text-align-center" id="new-tab" data-pro="<?= $router -> getRouteParam('2') ?>">Nouveau tableau</div>
</div>