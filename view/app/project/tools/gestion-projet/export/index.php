<?php
    require_once ('controller/project.php') ;
    require_once ('controller/task.php') ;

    $tabTasks = $task -> getTabTasks( $router -> getRouteParam('6') );

    header("Content-Type: text/plain");
    header("Content-disposition: attachment; filename=data.csv");
    

    $out = fopen('PHP://output', 'w');
    fputcsv($out, array(
        "project_token",
        "tab_token",
        "public_token",
        "name",
        "position",
        "creation_date",
        "end_date",
        "deadline",
        "duration",
        "assigned_members",
        "assigned_teams",
        "level"
    ));
    
    foreach( $tabTasks as $row ):
        fputcsv($out, array(
            $row['project_token'],
            $row['tab_token'],
            $row['task_token'],
            $row['position'],
            $row['date_creation'],
            $row['date_end'],
            $row['deadline'],
            $row['duration'],
            $row['assigned_members'],
            $row['assigned_teams'],
            $row['level'],
        ));
    endforeach;
    fclose($out);    