<?php

class task extends project {



/******************************************************************************/

    /**
     * Récupère les tableau de taches d'un projet
     * 
     * Va renvoyer tout les tableau de taches d'un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @return array
     */
    
    function getTabs($project_token = '') {
        $request = $this -> _db -> query("SELECT * FROM `pt_task_tab` WHERE `project_token` = '$project_token' AND `enable` = '1' ");
        $res = $request->fetchAll();
        $count = $request->rowCount();

        return ([ 
            'count' => $count, 
            'content' => $res
        ]);
    }



    /**
     * Créer un tableau
     * 
     * Va créer un tableau pour un projet
     *
     * @access public
     * @author Mikhaël Bailly
     * @param string $project_token Token du projet
     * @param string $name Nom du tableau
     * @return array
     */
    
    function newTab($project_token = '', $name = '') {
        $tabs = $this -> getTabs($project_token);
        $pos = $tabs['count'];
        $pos ++;
        $tab_token = main::generateToken(10, 'numbers-letters_min');

        $req = $this -> _db -> prepare("INSERT INTO `pt_task_tab` (`project_token`, `tab_token`, `position`, `name`) VALUES (:project_token, :tab_token, :position, :name)");

        $req->bindParam(':project_token', $project_token);
        $req->bindParam(':tab_token', $tab_token);
        $req->bindParam(':position', $pos);
        $req->bindParam(':name', $name);

        $req->execute();
        $count = $req->rowCount();

        if($count !== 1){
            return (['success' => false, 'options' => ['content' => "Une erreur est survenue !", 'theme' => 'error'] ]);
        }
        return (['success' => true, 'options' => ['content' => "Le tableau a été crée !", 'theme' => 'success'] ]);

    }
 
/******************************************************************************/

}
