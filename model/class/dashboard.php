<?php

class dashboard extends db_connect {

    function __construct($connect){
        parent::__construct($connect);
    }


/******************************************************************************/

    /**
     * Récupère les taches de tableaux selon leur status
     * 
     * Récupérer les tâches d'un tableau de projet selon leur status (en cours, en retard ou terminé)
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $tab_token Token du tableau
     * @param string $status Status de la tâche
     * @return string
     */

    function getTabTasksPerStatus($project_token, $tab_token, $status) {
        if($status == 'working'){ 
            $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `deadline` > NOW() AND `date_end` IS NULL AND `enable` = '1'");
        }else if($status == 'late'){
            $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `deadline` < NOW() AND `date_end` IS NULL AND `enable` = '1'");
        }else if($status == 'ended'){
            $request = $this -> _db -> query("SELECT * FROM `pr_task_item` WHERE `project_token` = '$project_token' AND `tab_token` = '$tab_token' AND `deadline` < NOW() AND `date_end` IS NOT NULL AND `enable` = '1'");
        }else{
            return ([ 'count' => 0, 'content' => [] ]);
        }
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);

    }


/******************************************************************************/

}
