<?php
    $tabs = $task -> getTabs( $router -> getRouteParam('2') );
?>


<div id="demo" class="mr-top-lg mermaid">
    gantt
    dateFormat  YYYY-MM-DD
    title Votre diagramme de GANTT

    <?php
        foreach($tabs['content'] as $t){
            ?>
            section <?= $t['name']; ?>

            <?php
            $tasks = $task -> getTabTasks($t['tab_token']);
            $c = 1;
            foreach($tasks['content'] as $task_item){
                $date1 = new DateTime();
                $date2 = new DateTime( $task_item['deadline'] );
                $interval = $date1->diff($date2);
                $date_creation = new DateTime( $task_item['date_creation'] );
                $deadline = $date2->format('Y-m-d');
                $count = ($c == 1) ? 'a1' : 'after a1';


                if(isset($task_item['date_end'])){
                    $status = 'done';
                }else{
                    if($date1 < $date2){
                        $status = 'active';
                    }else{
                        $status = 'crit';
                    }
                }

            ?>
            <?= $task_item['name'] ?>               :<?= $status ?>, <?= $deadline ?>, <?= date("h", strtotime( $task_item['duration'] )) ?>H
            <?php
            $c ++;
            }
            ?>
            <?php
        }
    ?>
</div>
